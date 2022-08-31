<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Models\UserSearch;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    use HasFactory;


    /**
     * ユーザ一覧画面表示
     * @return view
     */
    public function users(Request $request) {
        $input = $request->only('name', 'email', 'room_id', 'area', 'role', 'created_at');
        $users = UserSearch::search($input)
            ->orderBy('id', 'desc')
            ->where('deleted_at', null)
            ->paginate(10);


        // select box用変数
        $room_ids = User::select('room_id')
            ->groupBy('room_id')
            ->pluck('room_id');


        return view('users.users',
            [
                // select box用変数
                'users' => $users,
                'room_ids' => $room_ids,

                // 検索項目
                'name' => $input['name'] ?? '',
                'email' => $input['email'] ?? '',
                'room_id' => $input['room_id'] ?? '',
                'area' => $input['area'] ?? '',
                'role' => $input['role'] ?? '',
                'created_at' => $input['created_at'] ?? '',
            ]
        );
    }

    /**
     * ユーザ詳細ページ表示
     * @param $id
     * @return view
     */
    public function user_detail($id) {
        $user = User::find($id);

        return view('users.user_detail', ['user' => $user]);
    }

    /**
     * ユーザ編集画面表示
     * @param $id
     * @return view
     */
    public function user_edit($id) {
        $user = User::find($id);

        return view('users.user_edit', ['user' => $user]);
    }

    /**
     * ユーザ情報変更の実行
     * @param $request
     * @return redirect
     */
    public function user_update(UserRequest $request) {
        try {
            DB::beginTransaction();

            $user = User::find($request->input('id'));

            $user->fill(
                [
                    'name' => $request->name,
                    'email' => $request->email,
                    'room_id' => $request->room_id,
                    'area' => $request->area,
                    'role' => $request->role,
                ]
            );

            // 変更保存
            $user->save();

            DB::commit();

            // 変更後リダイレクト
            return redirect('/users')->with('status', 'ユーザ情報を更新しました！');

        } catch (\Exception $ex) {
            DB::rollback();

            logger($ex->getMessage());
            return redirect('/users')->withErrors($ex->getMessage());

        }
    }

    /**
     * ユーザ削除の実行
     * @param $id
     * @return redirect
     */
    public function user_remove($id) {
        try {
            User::find($id)->delete();
            return redirect('/users')->with('status', '該当の家事を削除しました！');

        } catch (\Exception $ex) {
            logger($ex->getMessage());
            return redirect('/users')->withErrors($ex->getMessage());
        }
    }
}
