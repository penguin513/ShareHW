<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ScheduleRequest;
use App\Models\Schedule;
use App\Models\ScheduleSearch;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;



class SchedulesController extends Controller
{
    use HasFactory;


    /**
     * トップページ（家事一覧ページ）
     * @return view
     */
    public function schedule(Request $request) {
        $user = Auth::user();
        $user_room_id = $user->room_id;
        $user_role = $user->role;
        $pic_members = User::where('room_id', '=', $user_room_id)->get('name');
        $all_pic_members = User::get('name');


        if ($user_role === 1) {
            $input = $request->only('room_id', 'day_of_week', 'name', 'message', 'point', 'pic_name', 'created_at');
            $schedules = ScheduleSearch::search($input)
                ->orderBy('id', 'desc')
                ->paginate(10);

            $room_ids = Schedule::select('room_id')
                ->groupBy('room_id')
                ->pluck('room_id');
            $day_of_weeks = Schedule::select('day_of_week')
                ->groupBy('day_of_week')
                ->pluck('day_of_week');
            $points = Schedule::select('point')
                ->groupBy('point')
                ->pluck('point');
            $pic_members = Schedule::select('pic_name')
                ->groupBy('pic_name')
                ->pluck('pic_name');

        } else {
            $input = $request->only('day_of_week', 'name', 'message', 'point', 'pic_name', 'created_at');
            $schedules = ScheduleSearch::search($input)
                ->orderBy('id', 'desc')
                ->where('room_id', '=', $user_room_id)
                ->paginate(10);

            $day_of_weeks = Schedule::select('day_of_week')
                ->groupBy('day_of_week')
                ->pluck('day_of_week');
            $points = Schedule::select('point')
                ->groupBy('point')
                ->pluck('point');
            $pic_names = Schedule::select('pic_name')
                ->where('room_id', '=', $user_room_id)
                ->groupBy('pic_name')
                ->pluck('pic_name');
        }


        // chart用変数(本日の家事負担率)
        $aDay_sum_point = Schedule::where('room_id', '=', $user_room_id)->where(
            function ($query) {
                $query->where('day_of_week', '=', '1')
                    ->orWhere('day_of_week', '=', '2')
                    ->orWhere('day_of_week', '=', '3')
                    ->orWhere('day_of_week', '=', '4')
                    ->orWhere('day_of_week', '=', '5')
                    ->orWhere('day_of_week', '=', '6')
                    ->orWhere('day_of_week', '=', '7');
            }
        )->selectRaw('SUM(point) as aDay_sum_point')
        ->get('point')[0]->aDay_sum_point;

        $holiday_half_point = Schedule::where('room_id', '=', $user_room_id)
            ->where('day_of_week', '=', '10')
            ->selectRaw('SUM(point) as holiday_half_point')
            ->get('point')[0]->holiday_half_point;
        $holiday_sum_point = $holiday_half_point * 2;

        $weekday_half_point = Schedule::where('room_id', '=', $user_room_id)
            ->where('day_of_week', '=', '9')
            ->selectRaw('SUM(point) as weekday_half_point')
            ->get('point')[0]->weekday_half_point;
        $weekday_sum_point = $weekday_half_point * 5;

        $everyday_half_point = Schedule::where('room_id', '=', $user_room_id)
            ->where('day_of_week', '=', '8')
            ->selectRaw('SUM(point) as everyday_half_point')
            ->get('point')[0]->everyday_half_point;
        $everyday_sum_point = $everyday_half_point * 7;

        $allDay_sum_point = $aDay_sum_point + $holiday_sum_point + $weekday_sum_point + $everyday_sum_point;


        // チャート用処理
        $point_users = Schedule::where('room_id', '=', $user_room_id)
            ->select('day_of_week', 'pic_name', 'point')
            ->get();

        $point_users_array = $point_users->toArray();
        $point_user_array = [];

        foreach ($point_users_array as $value) {
            if ($value['day_of_week'] == 8) {
                 $value['point'] = $value['point'] * 7;
            } elseif ($value['day_of_week'] == 9) {
                 $value['point'] = $value['point'] * 5;
            } elseif ($value['day_of_week'] == 10) {
                 $value['point'] = $value['point'] * 2;
            }

            array_push($point_user_array,
                [
                    'pic_name' => $value['pic_name'],
                    'point' => $value['point']
                ]);
        }


        function groupItemsByColumn(Collection|array $items, String $column) : array {
            $items = is_array($items) ? $items : $items->toArray();
            if (empty($items)) return [];

            return array_reduce($items, function (array $acc, array $el) use ($column) {
                $group = $el[$column];
                $acc[$group][] = $el;
                return $acc;
            }, []);
        }

        $group_point_users = groupItemsByColumn($point_user_array, 'pic_name');


        $user_sum_array = [];
        $user_list = [];
        $user_list_count = [];
        $point_sum_array = [];
        $ass_user_point = [];
        $user_list_arsort = [];
        $ratio_list_arsort = [];

        foreach ($group_point_users as $key => $value) {
            array_push($user_list, $key);
        }

        foreach ($group_point_users as $key => $value) {
            $count = count($value);
            array_push($user_list_count, $count);
        }


        foreach ($user_list as $key => $user_name) {
            $total = 0;

            for ($i=0; $i<$user_list_count[$key]; $i++) {
                $total += $group_point_users[$user_name][$i]['point'];
            }

            array_push($user_sum_array,
                [
                    'point' => round($total / $allDay_sum_point * 100, 1),
                ]
            );
        }

        foreach ($user_sum_array as $key => $value){
            foreach ($value as $value2) {
                array_push($point_sum_array, $value2);
            }
        }

        for ($i=0; $i<count($user_list); $i++) {
            $ass_user_point[$user_list[$i]] = $point_sum_array[$i];
        }

        arsort($ass_user_point);

        foreach ($ass_user_point as $name => $ratio) {
            array_push($user_list_arsort, $name);
            array_push($ratio_list_arsort, $ratio);
        }


        if ($user_role === 1) {
            return view('houseworks.houseworks_schedule',
                [
                    'schedules' => $schedules,
                    'room_ids' => $room_ids,
                    'day_of_weeks' => $day_of_weeks,
                    'points' => $points,
                    'pic_names' => $all_pic_members,

                    // 検索項目
                    'room_id' => $input['room_id'] ?? '',
                    'day_of_week' => $input['day_of_week'] ?? '',
                    'name' => $input['name'] ?? '',
                    'message' => $input['message'] ?? '',
                    'point' => $input['point'] ?? '',
                    'pic_name' => $input['pic_name'] ?? '',
                    'created_at' => $input['created_at'] ?? '',
                ]
            )->with([
                'point_users' => $point_users,
                'user_role' => $user_role,
                'pic_members' => $pic_members,
                'all_pic_members' => $all_pic_members,
                'allDay_sum_point' => $allDay_sum_point,
                'everyday_sum_point' => $everyday_sum_point,
                'user_list_arsort' => $user_list_arsort,
                'ratio_list_arsort' => $ratio_list_arsort,

            ]);

        } else {
            return view('houseworks.houseworks_schedule',
                [
                    'schedules' => $schedules,
                    'day_of_weeks' => $day_of_weeks,
                    'points' => $points,
                    'pic_names' => $pic_names,

                    // 検索項目
                    'day_of_week' => $input['day_of_week'] ?? '',
                    'name' => $input['name'] ?? '',
                    'message' => $input['message'] ?? '',
                    'point' => $input['point'] ?? '',
                    'pic_name' => $input['pic_name'] ?? '',
                    'created_at' => $input['created_at'] ?? '',
                ]
            )->with([
                'point_users' => $point_users,
                'user_role' => $user_role,
                'pic_members' => $pic_members,
                'allDay_sum_point' => $allDay_sum_point,
                'user_list_arsort' => $user_list_arsort,
                'ratio_list_arsort' => $ratio_list_arsort,

            ]);
        }
    }


    /**
     * 家事詳細ページ
     * @param $id
     * @return view
     */
    public function schedule_detail($id) {
        $schedule = Schedule::find($id);

        return view('houseworks.housework_schedule_detail', ['schedule' => $schedule]);
    }


    /**
     * 家事変更ページ
     * @param $id
     * @return view
     */
    public function schedule_edit($id) {
        $schedule = Schedule::find($id);
        $user = Auth::user();
        $user_room = $user->room_id;
        $pic_names = User::where('room_id', '=', $user_room)->get('name');

        $user_role = $user->role;
        $this_room_id = $schedule->room_id;
        $this_pic_members = User::where('room_id', '=', $this_room_id)->get('name');

        return view('houseworks.housework_schedule_edit',
            [
                'schedule' => $schedule,
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
    public function schedule_update(ScheduleRequest $request) {
        $now = \Carbon\Carbon::now()->format('H');
        if (4 > $now) {
            $today_of_week = \Carbon\Carbon::yesterday()->dayOfWeekIso;
        } else {
            $today_of_week = \Carbon\Carbon::now()->dayOfWeekIso;
        }

        try {
            DB::beginTransaction();

            $schedule = Schedule::find($request->input('id'));

            $schedule->fill(
                [
                    'room_id' => $request->room_id,
                    'day_of_week' => $request->day_of_week,
                    'name' => $request->name,
                    'message' => $request->message,
                    'point' => $request->point,
                    'add_name' => $request->add_name,
                    'pic_name' => $request->pic_name,
                ]
            );

            // 変更保存
            $schedule->save();

            DB::commit();

            // 変更後リダイレクト
            return redirect("/houseworks/schedule")->with('status', '該当の家事を更新しました！');

        } catch (\Exception $ex) {
            DB::rollback();

            logger($ex->getMessage());
            return redirect("/houseworks/schedule")->withErrors($ex->getMessage());

        }
    }


    /**
     * 新規家事追加ページ
     * @return view
     */
    public function schedule_new() {
        $user = Auth::user();
        $user_room = $user->room_id;
        $pic_names = User::where('room_id', '=', $user_room)->get('name');

        return view('houseworks.housework_schedule_create', ['user' => $user])->with(['pic_names' => $pic_names]);
    }


    /**
     * 新規家事追加の実行
     * @param $request
     * @return redirect
     */
    public function schedule_create(ScheduleRequest $request) {
        $now = \Carbon\Carbon::now()->format('H');
        if (4 > $now) {
            $today_of_week = \Carbon\Carbon::yesterday()->dayOfWeekIso;
        } else {
            $today_of_week = \Carbon\Carbon::now()->dayOfWeekIso;
        }

        try {
            Schedule::create(
                [
                    'room_id' => $request->room_id,
                    'day_of_week' => $request->day_of_week,
                    'name' => $request->name,
                    'message' => $request->message,
                    'point' => $request->point,
                    'add_name' => $request->add_name,
                    'pic_name' => $request->pic_name,
                ]
            );
            return redirect("/houseworks/schedule")->with('status', '新しい家事を追加しました！');

        } catch (\Exception $ex) {
            logger($ex->getMessage());
            return redirect("/houseworks/schedule")->withErrors($ex->getMessage());
        }
    }


    /**
     * 家事削除の実行
     * @param $id
     * @return redirect
     */
    public function schedule_remove($id) {
        $now = \Carbon\Carbon::now()->format('H');
        if (4 > $now) {
            $today_of_week = \Carbon\Carbon::yesterday()->dayOfWeekIso;
        } else {
            $today_of_week = \Carbon\Carbon::now()->dayOfWeekIso;
        }

        try {
            Schedule::find($id)->delete();
            return redirect("/houseworks/schedule")->with('status', '該当の家事を削除しました！');

        } catch (\Exception $ex) {
            logger($ex->getMessage());
            return redirect("/houseworks/schedule")->withErrors($ex->getMessage());
        }
    }
}
