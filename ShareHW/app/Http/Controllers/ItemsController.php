<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemRequest;
use App\Models\Item;
use App\Models\ItemSearch;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;

class ItemsController extends Controller
{
    use HasFactory;

    /**
     * トップページ（アイテム一覧ページ）
     * @return view
     */
    public function item(Request $request) {
        $user = Auth::user();
        $user_room_id = $user->room_id;
        $user_role = $user->role;


        if ($user_role === 1) {
            $input = $request->only('room_id', 'name', 'message', 'category', 'required', 'created_at');

            $items = ItemSearch::search($input)
                ->orderBy('id', 'desc')
                ->paginate(10);

            $room_ids = Item::select('room_id')
                ->groupBy('room_id')
                ->pluck('room_id');
            $categories = Item::select('category')
                ->groupBy('category')
                ->pluck('category');
            $requireds = Item::select('required')
                ->groupBy('required')
                ->pluck('required');

        } else {
            $input = $request->only('name', 'message', 'category', 'required', 'created_at');

            $items = ItemSearch::search($input)
                ->orderBy('id', 'desc')
                ->where('room_id', '=', $user_room_id)
                ->paginate(10);

            $categories = Item::select('category')
                ->where('room_id', '=', $user_room_id)
                ->groupBy('category')
                ->pluck('category');
            $requireds = Item::select('required')
                ->where('room_id', '=', $user_room_id)
                ->groupBy('required')
                ->pluck('required');
        }

        if ($user_role === 1) {
            return view('items.items',
                [
                    'items' => $items,
                    'room_ids' => $room_ids,
                    'categories' => $categories,
                    'requireds' => $requireds,

                    // 検索項目
                    'room_id' => $input['room_id'] ?? '',
                    'name' => $input['name'] ?? '',
                    'message' => $input['message'] ?? '',
                    'category' => $input['category'] ?? '',
                    'required' => $input['required'] ?? '',
                    'created_at' => $input['created_at'] ?? '',
                ]
            )->with(['user_role' => $user_role]);
        } else {
            return view('items.items',
                [
                    'items' => $items,
                    'categories' => $categories,
                    'requireds' => $requireds,

                    // 検索項目
                    'name' => $input['name'] ?? '',
                    'message' => $input['message'] ?? '',
                    'category' => $input['category'] ?? '',
                    'required' => $input['required'] ?? '',
                    'created_at' => $input['created_at'] ?? '',
                ]
            )->with(['user_role' => $user_role]);
        }
    }

    /**
     * アイテム詳細ページ
     * @param $id
     * @return view
     */
    public function item_detail($id) {
        $item = Item::find($id);

        return view('items.item_detail', ['item' => $item]);
    }

    /**
     * アイテム変更ページ
     * @param $id
     * @return view
     */
    public function item_edit($id) {
        $item = Item::find($id);
        $user = Auth::user();
        $user_room = $user->room_id;
        $add_name = $user->name;

        return view('items.item_edit',
            [
                'item' => $item,
                'user_room' => $user_room,
                'add_name' => $add_name,
            ]
        );
    }

    /**
     * アイテム変更の実行
     * @param $request
     * @return redirect
     */
    public function item_update(ItemRequest $request) {
        try {
            DB::beginTransaction();

            $item = Item::find($request->input('id'));

            // アップロードされたファイル名を取得
            $img = $request->file('photo');
            // 画像パスをセット
            $path = $item->photo;

            if (isset($img)) {
                // 画像アップロードがある場合
                if (isset($path)) {
                    // 現在の画像ファイルを削除
                    Storage::disk('public')->delete($path);
                }
                // 新たにアップロードされた画像ファイルを保存
                $path = $img->store('item_img', 'public');

                $item->fill(
                    [
                        'room_id' => $request->room_id,
                        'add_name' => $request->add_name,
                        'name' => $request->name,
                        'photo' => $path,
                        'message' => $request->message,
                        'category' => $request->category,
                        'required' => $request->required,
                    ]
                );
            } else {
                $item->fill(
                    [
                        'room_id' => $request->room_id,
                        'add_name' => $request->add_name,
                        'name' => $request->name,
                        'message' => $request->message,
                        'category' => $request->category,
                        'required' => $request->required,
                    ]
                );
            }


            // 変更保存
            $item->save();

            DB::commit();

            // 変更後リダイレクト
            return redirect('/items')->with('status', 'アイテムを更新しました！');


        } catch (\Exception $ex) {
            DB::rollback();

            logger($ex->getMessage());
            return redirect('/items')->withErrors($ex->getMessage());

        }
    }

    /**
     * 新規アイテム追加ページ
     * @return view
     */
    public function item_new() {
        $user = Auth::user();

        return view('items.item_create',
            [
                'user' => $user,
            ]
        );
    }

    /**
     * 新規アイテム追加の実行
     * @param $request
     * @return redirect
     */
    public function item_create(ItemRequest $request) {
        try {
            // アップロードされたファイル名を取得
            $img = $request->file('photo');
            // 取得したファイル名で保存
            $path = isset($img) ? $img->store('item_img', 'public') : null;

            // 画像アップロードがある場合
            Item::create(
                [
                    'room_id' => $request->room_id,
                    'add_name' => $request->add_name,
                    'name' => $request->name,
                    'photo' => $path,
                    'message' => $request->message,
                    'category' => $request->category,
                    'required' => $request->required,
                ]
            );


            return redirect("/items")->with('status', '新しいアイテムを追加しました！');

        } catch (\Exception $ex) {
            logger($ex->getMessage());
            return redirect("/items")->withErrors($ex->getMessage());
        }
    }

    /**
     * アイテム削除の実行
     * @param $id
     * @return redirect
     */
    public function Item_remove($id) {
        try {
            // 商品画像ファイルへのパスを取得
            $path = Item::find($id)->photo;
            // ファイルが登録されていれば削除
            if (isset($path)) {
                Storage::disk('public')->delete($path);
            }

            Item::find($id)->delete();
            return redirect('/items')->with('status', '該当のアイテムを削除しました！');

        } catch (\Exception $ex) {
            logger($ex->getMessage());
            return redirect('/items')->withErrors($ex->getMessage());
        }
    }
}
