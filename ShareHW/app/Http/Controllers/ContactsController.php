<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use Illuminate\Support\Facades\Auth;
use App\Mail\ContactMail;
use App\Mail\ContactMailAdmin;
use App\Models\Contact;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;



class ContactsController extends Controller
{

    /**
     * お問い合わせトップページ
     * @return view
     */
    public function contact(Request $request) {
        $request->session()->forget('inputs');

        return view('contact.contact');
    }

    /**
     * お問い合わせ確認ページ表示
     * @param $request
     * @return view
     */
    public function contact_send(ContactRequest $request) {
        $user = Auth::user();
        $data = $request;

        return view('contact.confirm',
            [
                'user' => $user,
                'data' => $data,
            ]
        );
    }

    /**
     * お問い合わせ確認ページ不正表示（URL直打ち対策）
     * @param $request
     * @return view
     */
    public function confirm_ill() {
        return redirect('/contact');
    }


    /**
     * お問い合わせ確認ページ処理
     * @param $request
     * @return view
     */
    public function confirm(ContactRequest $request) {
        $action = $request->input('action');

        $inputs = $request->except('action');
        $request->session()->put('inputs', $inputs);


        if ($action === 'submit') {
            try {
                Contact::create(
                    [
                        'user_id' => $request->user_id,
                        'room_id' => $request->room_id,
                        'email' => $request->email,
                        'name' => $request->name,
                        'category' => $request->category,
                        'message' => $request->message,
                    ]
                );

                $contact = $request->all();

                Mail::to($contact['email'])->send(new ContactMail($contact));
                Mail::to('penguin5131029@gmail.com')->send(new ContactMailAdmin($contact));


                $request->session()->regenerateToken();

                return redirect('/contact/thanks')->with('status', 'お問い合わせを受け付けました！');

            } catch (\Exception $ex) {
                logger($ex->getMessage());
                return redirect('/contact')->withErrors($ex->getMessage())->with('status', 'お問い合わせの送信に失敗しました。もう一度送信してください。');
            }

        } else {
            DB::rollback();

            return redirect()
                ->route('contact')
                ->withInput();
        }
    }

    /**
     * お問い合わせ完了ページ
     *
     * @return view
     */
    public function thanks(Request $request) {
        $inputs = $request->session()->get('inputs');

        if (!isset($inputs)) {
            return redirect('/contact');
        }

        $request->session()->flush();
        return view('contact.thanks');

    }

    /**
     * お問い合わせトップページ
     *
     * @return view
     */
    public function privacy() {
        return view('privacy');
    }
}
