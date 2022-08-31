<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;



class ChangePasswordController extends Controller {


    /**
     * Create a new controller instance.
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    protected function validator(array $data) {
        return Validator::make($data,
        [
            'new_password' => 'required | string | min:8 | confirmed',
            ]
        );
    }

    /**
     * パスワード変更画面
     * @return view
     */
    public function password_change() {
        return view('password.change');
    }

    /**
     * パスワード変更処理
     * @param $request
     * @return redirect
     */
    public function password_update(Request $request) {
        $user = Auth::user();
        if (!password_verify($request->current_password, $user->password)) {
            return redirect('/mypage/password/change')->with('warning', '現在のパスワードが違います');
        }

        if ($request->new_password !== $request->new_password_confirmation) {
            return redirect('/mypage/password/change')->with('warning', '確認パスワードが新しいパスワードと一致しません');
        }

        //新規パスワードの確認
        $this->validator($request->all())->validate();

        $user->password = bcrypt($request->new_password);
        $user->save();

        return redirect('/mypage')->with('status', 'パスワードの変更が完了しました');
    }
}
