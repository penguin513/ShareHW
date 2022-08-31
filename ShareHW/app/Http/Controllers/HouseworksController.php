<?php
namespace App\Http\Controllers;

use App\Http\Requests\HouseworkRequest;
use App\Models\Housework;
use App\Models\Schedule;
use App\Models\HouseworkSearch;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;



class HouseworksController extends Controller
{
    use HasFactory;


    /**
     * トップページ（家事一覧ページ）
     * @return view
     */
    public function housework(Request $request) {
        $user = Auth::user();
        $user_room_id = $user->room_id;
        $user_role = $user->role;
        $pic_members = User::where('room_id', '=', $user_room_id)->get('name');
        $all_pic_members = User::get('name');


        if ($user_role === 1) {
            $input = $request->only('room_id', 'name', 'message', 'point', 'pic_name', 'status', 'created_at');
            $houseworks = HouseworkSearch::search($input)
                ->orderBy('id', 'desc')
                ->paginate(10);

            $room_ids = Housework::select('room_id')
                ->groupBy('room_id')
                ->pluck('room_id');
            $points = Housework::select('point')
                ->groupBy('point')
                ->pluck('point');
            $pic_members = Housework::select('pic_name')
                ->groupBy('pic_name')
                ->pluck('pic_name');

        } else {
            $input = $request->only('name', 'message', 'point', 'pic_name', 'status', 'created_at');
            $houseworks = HouseworkSearch::search($input)
                ->orderBy('id', 'desc')
                ->where('room_id', '=', $user_room_id)
                ->paginate(10);

            $points = Housework::select('point')
                ->groupBy('point')
                ->pluck('point');
            $pic_names = Housework::select('pic_name')
                ->where('room_id', '=', $user_room_id)
                ->groupBy('pic_name')
                ->pluck('pic_name');
        }


        // chart用変数(本日の達成度)
        $now = intval(date('H'));
        if (4 > $now) {
            $today = date('Y-m-d', strtotime('-1 day'));
        } else {
            $today = date('Y-m-d');
        }

        $user_name = Auth::user()->name;
        $today_my_tasc = Housework::where('room_id', '=', $user_room_id)
            ->where('pic_name', '=', $user_name)
            ->where('created_at', 'like', "$today%");
        $count = $today_my_tasc->count();

        $undone_tasc_count = $today_my_tasc
            ->where('status', '=', '1')
            ->count();
        $doing_tasc_count = Housework::where('room_id', '=', $user_room_id)
            ->where('pic_name', '=', $user_name)
            ->where('created_at', 'like', "$today%")
            ->where('status', '=', '2')
            ->count();
        $done_tasc_count = Housework::where('room_id', '=', $user_room_id)
            ->where('pic_name', '=', $user_name)
            ->where('created_at', 'like', "$today%")
            ->where('status', '=', '3')
            ->count();

        $status_counts = [$undone_tasc_count, $doing_tasc_count, $done_tasc_count];
        $status_list = ['未実施', '実施中', '完了！'];


        // chart用変数(本日の家事負担率)
        $sum_point = Housework::where('room_id', '=', $user_room_id)
            ->where('created_at', 'like', "$today%")
            ->selectRaw('SUM(point) as sum_point')
            ->get('point')[0]->sum_point;
        $point_users = Housework::where('room_id', '=', $user_room_id)
            ->where('created_at', 'like', "$today%")
            ->select('pic_name')
            ->selectRaw('SUM(point) as sum_point')
            ->groupBy('pic_name')
            ->get();


        // 天気予報API用地域コード
        $area_code = Auth::user()->area;


        if ($user_role === 1) {
            return view('houseworks.houseworks',
                [
                    'houseworks' => $houseworks,
                    'room_ids' => $room_ids,
                    'points' => $points,
                    'pic_names' => $all_pic_members,

                    // 検索項目
                    'room_id' => $input['room_id'] ?? '',
                    'name' => $input['name'] ?? '',
                    'message' => $input['message'] ?? '',
                    'point' => $input['point'] ?? '',
                    'pic_name' => $input['pic_name'] ?? '',
                    'status' => $input['status'] ?? '',
                    'created_at' => $input['created_at'] ?? '',
                ]
            )->with([
                'count' => $count,
                'user_name' => $user_name,
                'status_counts' => $status_counts,
                'status_list' => $status_list,
                'sum_point' => $sum_point,
                'point_users' => $point_users,
                'area_code' => $area_code,
                'user_role' => $user_role,
                'now' => $now,
                'pic_members' => $pic_members,
                'all_pic_members' => $all_pic_members,

            ]);

        } else {
            return view('houseworks.houseworks',
                [
                    'houseworks' => $houseworks,
                    'points' => $points,
                    'pic_names' => $pic_names,

                    // 検索項目
                    'name' => $input['name'] ?? '',
                    'message' => $input['message'] ?? '',
                    'point' => $input['point'] ?? '',
                    'pic_name' => $input['pic_name'] ?? '',
                    'status' => $input['status'] ?? '',
                    'created_at' => $input['created_at'] ?? '',
                ]
            )->with([
                'count' => $count,
                'user_name' => $user_name,
                'status_counts' => $status_counts,
                'status_list' => $status_list,
                'sum_point' => $sum_point,
                'point_users' => $point_users,
                'area_code' => $area_code,
                'user_role' => $user_role,
                'now' => $now,
                'pic_members' => $pic_members,

            ]);
        }
    }



    /**
     * トップページチェック処理
     * @param $request
     * @return redirect
     */
    public function check(Request $request) {
        $housework = Housework::find($request->id);

        if ($housework->status === 1) {
            $housework->status = 2;

        } elseif ($housework->status === 2) {
            $housework->status = 3;

        } else {
            $housework->status = 1;
        }

        $housework->save();

        return redirect()->to(url()->previous());
    }



    /**
     * 家事詳細ページ
     * @param $id
     * @return view
     */
    public function housework_detail($id) {
        $housework = Housework::find($id);

        return view('houseworks.housework_detail', ['housework' => $housework]);
    }



    /**
     * 家事変更ページ
     * @param $id
     * @return view
     */
    public function housework_edit($id) {
        $housework = Housework::find($id);
        $user = Auth::user();
        $user_room = $user->room_id;
        $pic_names = User::where('room_id', '=', $user_room)->get('name');

        $user_role = $user->role;
        $this_room_id = $housework->room_id;
        $this_pic_members = User::where('room_id', '=', $this_room_id)->get('name');

        return view('houseworks.housework_edit',
            [
                'housework' => $housework,
                'user_role' => $user_role,
                'pic_names' => $pic_names,
                'this_pic_members' => $this_pic_members,
            ]
        );
    }



    /**
     * 家事変更の実行
     * @param $request
     * @return redirect
     */
    public function housework_update(HouseworkRequest $request) {
        $now = intval(date('H'));
        if (4 > $now) {
            $today = date('Y-m-d', strtotime('-1 day'));
        } else {
            $today = date('Y-m-d');
        }

        try {
            DB::beginTransaction();

            $housework = Housework::find($request->input('id'));

            $housework->fill(
                [
                    'room_id' => $request->room_id,
                    'name' => $request->name,
                    'message' => $request->message,
                    'point' => $request->point,
                    'add_name' => $request->add_name,
                    'pic_name' => $request->pic_name,
                    'status' => $request->status,
                ]
            );

            // 変更保存
            $housework->save();

            DB::commit();

            // 変更後リダイレクト
            return redirect("/houseworks?created_at=$today")->with('status', '家事を更新しました！');


        } catch (\Exception $ex) {
            DB::rollback();

            logger($ex->getMessage());
            return redirect("/houseworks?created_at=$today")->withErrors($ex->getMessage());

        }
    }



    /**
     * 新規家事追加ページ
     * @return view
     */
    public function housework_new() {
        $user = Auth::user();
        $user_room = $user->room_id;
        $pic_names = User::where('room_id', '=', $user_room)->get('name');

        return view('houseworks.housework_create', ['user' => $user])->with(['pic_names' => $pic_names]);
    }



    /**
     * 新規家事追加の実行
     * @param $request
     * @return redirect
     */
    public function housework_create(HouseworkRequest $request) {
        $now = intval(date('H'));
        if (4 > $now) {
            $today = date('Y-m-d', strtotime('-1 day'));
        } else {
            $today = date('Y-m-d');
        }

        try {
            Housework::create(
                [
                    'room_id' => $request->room_id,
                    'name' => $request->name,
                    'message' => $request->message,
                    'point' => $request->point,
                    'add_name' => $request->add_name,
                    'pic_name' => $request->pic_name,
                    'status' => $request->status,
                ]
            );
            return redirect("/houseworks?created_at=$today")->with('status', '新しい家事を追加しました！');

        } catch (\Exception $ex) {
            logger($ex->getMessage());
            return redirect("/houseworks?created_at=$today")->withErrors($ex->getMessage());
        }
    }



    /**
     * 今日の家事追加処理
     * @param $request
     * @return redirect
     */
    public function clone() {
        $now = intval(date('H'));
        if (4 > $now) {
            $today = date('Y-m-d', strtotime('-1 day'));
            $today_of_week = date('N', strtotime('-1 day'));
        } else {
            $today = date('Y-m-d');
            $today_of_week = date('N');
        }


        $user = Auth::user();
        $room_id = $user->room_id;
        $schedules = Schedule::where('room_id', '=', $room_id)->get();

        foreach ($schedules as $schedule) {

            if ($today_of_week === '6' || $today_of_week === '7') {
                // 今日が休日（土日）の場合
                if ($schedule->day_of_week === (int)$today_of_week || $schedule->day_of_week === 8 || $schedule->day_of_week === 10) {
                    Housework::create(
                        [
                            'room_id' => $schedule->room_id,
                            'name' => $schedule->name,
                            'message' => $schedule->message,
                            'point' => $schedule->point,
                            'add_name' => $user->name,
                            'pic_name' => $schedule->pic_name,
                            'status' => 1,
                        ]
                    );
                }

            } else {
                // 今日が平日（月～金）の場合
                if ($schedule->day_of_week === (int)$today_of_week || $schedule->day_of_week === 8 || $schedule->day_of_week === 9) {
                    Housework::create(
                        [
                            'room_id' => $schedule->room_id,
                            'name' => $schedule->name,
                            'message' => $schedule->message,
                            'point' => $schedule->point,
                            'add_name' => $user->name,
                            'pic_name' => $schedule->pic_name,
                            'status' => 1,
                        ]
                    );
                }
            }

        }

        return redirect("/houseworks?created_at=$today")->with('status', '今日の家事を追加しました！');

    }



    /**
     * 家事削除の実行
     * @param $id
     * @return redirect
     */
    public function housework_remove($id) {
        $now = intval(date('H'));
        if (4 > $now) {
            $today = date('Y-m-d', strtotime('-1 day'));
        } else {
            $today = date('Y-m-d');
        }

        try {
            Housework::find($id)->delete();
            return redirect("/houseworks?created_at=$today")->with('status', '該当の家事を削除しました！');

        } catch (\Exception $ex) {
            logger($ex->getMessage());
            return redirect("/houseworks?created_at=$today")->withErrors($ex->getMessage());
        }
    }

}
