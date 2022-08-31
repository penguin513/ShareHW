<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Http\Requests\ChatRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Carbon;
use App\Models\Member;


class ChatsController extends Controller
{

    /**
     * トップページ（チャットページ）
     *
     * @return view
     */
    public function chat() {
        $user = Auth::user();
        $room_id = $user->room_id;
        $comments = Comment::where('room_id', '=', $room_id)->get();
        return view('chat.chat',
            [
                'comments' => $comments,
                'user' => $user,
            ]
        );
    }


    /**
     * メッセージ送信処理
     *
     * @return redirect
     */
    public function add(ChatRequest $request) {
        $user = Auth::user();
        $comment = $request->input('comment');

        Comment::create(
            [
                'user_id' => $user->id,
                'room_id' => $user->room_id,
                'name' => $user->name,
                'comment' => $comment
            ]
        );

        return redirect()->route('chat');
    }


    /**
     * コメント変更ページ
     * @param $id
     * @return view
     */
    public function chat_edit($id) {
        $comment = Comment::find($id);

        return view('chat.chat_edit', ['comment' => $comment]);
    }

    /**
     * コメント変更の実行
     * @param $request
     * @return redirect
     */
    public function chat_update(ChatRequest $request) {

        try {
            DB::beginTransaction();

            $comment = Comment::find($request->input('id'));

            $comment->fill(['comment' => $request->comment]);

            // 変更保存
            $comment->save();

            DB::commit();

            // 変更後リダイレクト
            return redirect("/chat")->with('status', 'コメントを更新しました！');


        } catch (\Exception $ex) {
            DB::rollback();

            logger($ex->getMessage());
            return redirect("/chat")->withErrors($ex->getMessage());

        }
    }


    /**
     * 家事削除の実行
     * @param $id
     * @return redirect
     */
    public function chat_remove($id) {

        try {
            Comment::find($id)->delete();
            return redirect("/chat")->with('status', '該当のコメントを削除しました！');

        } catch (\Exception $ex) {
            logger($ex->getMessage());
            return redirect("/chat")->withErrors($ex->getMessage());
        }
    }

}
