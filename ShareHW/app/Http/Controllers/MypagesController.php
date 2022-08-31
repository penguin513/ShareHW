<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\MypageRequest;
use App\Models\User;
use App\Models\Mypage;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;



class MypagesController extends Controller
{
    use HasFactory;

    /**
     * マイページ表示
     * @return view
     */
    public function mypage() {
        $user = Auth::user();
        $room_members = User::all()
            ->where('room_id', '=', $user->room_id);

        return view('mypage.mypage',
            [
                'user' => $user,
                'room_members' => $room_members,
            ]
        );
    }


    /**
     * マイページ編集画面表示
     * @return view
     */
    public function mypage_edit() {
        $user = Auth::user();

        return view('mypage.mypage_edit', ['user' => $user]);
    }

    /**
     * マイページ情報変更の実行
     * @param $request
     * @return redirect
     */
    public function mypage_update(MypageRequest $request) {
        try {
            DB::beginTransaction();

            $user = Mypage::find($request->input('id'));

            $user->fill(
                [
                    'name' => $request->name,
                    'email' => $request->email,
                    'room_id' => $request->room_id,
                    'area' => $request->area,
                    'color' => $request->color,
                ]
            );

            // 変更保存
            $user->save();

            DB::commit();

            // 変更後リダイレクト
            return redirect('/mypage')->with('status', 'ユーザ情報を更新しました！');

        } catch (\Exception $ex) {
            DB::rollback();

            logger($ex->getMessage());
            return redirect('/mypage')->withErrors($ex->getMessage());
        }
    }

    /**
     * 退会処理の実行
     * @return redirect
     */
    public function withdrawal() {
        $user = Auth::user();
        $user->delete();
        Auth::logout();

        return redirect(route('login'));
    }

}
