@extends('layouts.base_chat')


@section('body')
<x-app-layout>
    <x-slot name="header">
        <div class="flex mt-16">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight flex items-center">
                {{ __('みんなでチャット') }}
            </h2>
        </div>
    </x-slot>


    {{-- flashメッセージを表示 --}}
    @if (session('status'))
        <x-ui.flash_message class="fixed" message="{{ session('status') }}"></x-ui.flash_message>
    @endif


    <div class="chat-container flex justify-center w-full mt-5">
        <div class="chat-area w-11/12 sm:w-9/12 shadow-lg">
            <div class="card mt-0 bg-sky-blue-dark">
                <div class="card-header px-10 py-3 text-white font-bold bg-blue-900 text-center">{{ $user->name }}さんのチャット</div>
                <div class="card-body chat-card overflow-auto p-1 sm:p-5" style="height: calc(100vh - 380px);">
                    <div id="comment-data" class="media"></div>
                </div>
            </div>
        </div>
    </div>

    <form method="POST" action="{{route('add')}}">
        @csrf

        <div class="comment-container bottom-16 w-11/12 sm:w-9/12 mt-4 mx-auto">
            <div class="input-group comment-area flex">
                <textarea class="form-control w-full" id="comment" name="comment" placeholder="メッセージ送信 (ctrl + Enter)
※500文字以内"
                    aria-label="With textarea" onkeydown="if(event.ctrlKey&&event.keyCode==13){document.getElementById('submit').click();return false};" required></textarea>
                <button type="submit" id="submit" class="btn btn-outline-primary comment-btn px-6 my-0 ml-2 border whitespace-nowrap bg-blue-600 hover:bg-blue-400 text-white rounded-md"><img src="{{ asset('img/pngegg.png') }}" alt="送信" width="30" class="text-white"></button>
            </div>
            @error('comment')
                <div class="text-red-600 mt-2">{{ $message }}</div>
            @enderror
        </div>
    </form>


</x-app-layout>
@endsection

<div id="app"></div>



@section('script')
<script>
    const user_id = @json($user_id);

    window.addEventListener('DOMContentLoaded', function () {
        get_data();
    });

    function get_data() {
        $.ajax({
            url: "result/ajax/",
            dataType: "json",
            success: data => {
                $("#comment-data")
                    .find(".comment-visible")
                    .remove();


                // 日付をフォーマット
                for (var i = 0; i < data.comments.length; i++) {
                    const fullFormat = new Intl.DateTimeFormat(
                                                                undefined,
                                                                {
                                                                    year:   'numeric',
                                                                    month:  '2-digit',
                                                                    day:    '2-digit',
                                                                    hour:   '2-digit',
                                                                    minute: '2-digit',
                                                                }
                                                            );
                    const dayFormat = new Intl.DateTimeFormat(
                                                                undefined,
                                                                {
                                                                    year:   'numeric',
                                                                    month:  '2-digit',
                                                                    day:    '2-digit',
                                                                }
                                                            );
                    const timeFormat = new Intl.DateTimeFormat(
                                                                undefined,
                                                                {
                                                                    hour:   '2-digit',
                                                                    minute: '2-digit',
                                                                }
                                                            );
                    const created_at = new Date(data.comments[i].created_at);
                    const updated_at = new Date(data.comments[i].updated_at);
                    const today = new Date();
                    const yesterday = new Date().setDate(new Date().getDate() - 1);

                    const created_at_format = fullFormat.format(created_at);
                    const updated_at_format = fullFormat.format(updated_at);

                    const created_at_day = dayFormat.format(created_at);
                    const updated_at_day = dayFormat.format(updated_at);
                    const today_format = dayFormat.format(today);
                    const yesterday_format = dayFormat.format(yesterday);

                    const created_at_time = timeFormat.format(created_at);
                    const updated_at_time = timeFormat.format(updated_at);


                    // 各コメント日付処理
                    if (user_id === data.comments[i].user_id) {
                        // 自分のコメント

                        if (created_at_format !== updated_at_format) {
                            // 編集済の場合

                            if (created_at_day === today_format) {
                                // 今日に編集した場合
                                var html = `
                                    <div class="comment-visible block">
                                        <div class="media-body flex flex-col items-end">
                                            <div class="comment-body py-2 px-5 text-gray-800 hover:text-gray-600 rounded-lg block mt-8 ml-2 mr-0"
                                            style="background: #FF9999; width: 45%; min-width: 220px;">
                                                <p class="comment-body-content whitespace-pre-wrap" id="comment">${data.comments[i].comment}</p>
                                            </div>
                                            <div class="flex flex-col">
                                                <span class="comment-body-time text-xs ml-2 text-right mt-1" id="created_at">${created_at_time}</span>
                                                <span class="text-xs ml-2 text-right">編集済 ${updated_at_time}</span>
                                            </div>
                                            <x-dropdown_ope align="right" width="48">
                                                <x-slot name="trigger"><i class="fa-solid fa-feather-pointed mr-1"></i> 編集</x-slot>

                                                <x-slot name="content">
                                                    <x-dropdown-link href="/chat/edit/${data.comments[i].id}" class="text-center"><i class="fa-solid fa-pen-to-square"></i> 変更</x-dropdown-link>
                                                    <form method="POST" action="/chat/remove/${data.comments[i].id}" class="mb-0">
                                                        @csrf
                                                        @method('delete')

                                                        <x-dropdown-link_delete onclick="return confirm('本当に削除してもよろしいですか？');">✘  削除</x-dropdown-link_delete>
                                                    </form>
                                                </x-slot>
                                            </x-dropdown_ope>

                                        </div>
                                    </div>
                                `;

                            } else if (created_at_day === yesterday_format) {
                                // 昨日に編集した場合
                                if (updated_at_day === today_format) {
                                    var html = `
                                        <div class="comment-visible block">
                                            <div class="media-body flex flex-col items-end">
                                                <div class="comment-body py-2 px-5 text-gray-800 hover:text-gray-600 rounded-lg block mt-8 ml-2 mr-0"
                                                style="background: #FF9999; width: 45%; min-width: 220px;">
                                                    <p class="comment-body-content whitespace-pre-wrap" id="comment">${data.comments[i].comment}</p>
                                                </div>
                                                <div class="flex flex-col">
                                                    <span class="comment-body-time text-xs ml-2 text-right mt-1" id="created_at">昨日${created_at_time}</span>
                                                    <span class="text-xs ml-2 text-right">編集済 ${updated_at_time}</span>
                                                </div>
                                                <x-dropdown_ope align="right" width="48">
                                                    <x-slot name="trigger"><i class="fa-solid fa-feather-pointed mr-1"></i> 編集</x-slot>

                                                    <x-slot name="content">
                                                        <x-dropdown-link href="/chat/edit/${data.comments[i].id}" class="text-center"><i class="fa-solid fa-pen-to-square"></i> 変更</x-dropdown-link>
                                                        <form method="POST" action="/chat/remove/${data.comments[i].id}" class="mb-0">
                                                            @csrf
                                                            @method('delete')

                                                            <x-dropdown-link_delete onclick="return confirm('本当に削除してもよろしいですか？');">✘  削除</x-dropdown-link_delete>
                                                        </form>
                                                    </x-slot>
                                                </x-dropdown_ope>

                                            </div>
                                        </div>
                                    `;
                                } else {
                                    var html = `
                                        <div class="comment-visible block">
                                            <div class="media-body flex flex-col items-end">
                                                <div class="comment-body py-2 px-5 text-gray-800 hover:text-gray-600 rounded-lg block mt-8 ml-2 mr-0"
                                                style="background: #FF9999; width: 45%; min-width: 220px;">
                                                    <p class="comment-body-content whitespace-pre-wrap" id="comment">${data.comments[i].comment}</p>
                                                </div>
                                                <div class="flex flex-col">
                                                    <span class="comment-body-time text-xs ml-2 text-right mt-1" id="created_at">昨日${created_at_time}</span>
                                                    <span class="text-xs ml-2 text-right">編集済 昨日${updated_at_time}</span>
                                                </div>
                                                <x-dropdown_ope align="right" width="48">
                                                    <x-slot name="trigger"><i class="fa-solid fa-feather-pointed mr-1"></i> 編集</x-slot>

                                                    <x-slot name="content">
                                                        <x-dropdown-link href="/chat/edit/${data.comments[i].id}" class="text-center"><i class="fa-solid fa-pen-to-square"></i> 変更</x-dropdown-link>
                                                        <form method="POST" action="/chat/remove/${data.comments[i].id}" class="mb-0">
                                                            @csrf
                                                            @method('delete')

                                                            <x-dropdown-link_delete onclick="return confirm('本当に削除してもよろしいですか？');">✘  削除</x-dropdown-link_delete>
                                                        </form>
                                                    </x-slot>
                                                </x-dropdown_ope>

                                            </div>
                                        </div>
                                    `;
                                }
                            } else {
                                if (updated_at_day === today_format) {
                                    var html = `
                                        <div class="comment-visible block">
                                            <div class="media-body flex flex-col items-end">
                                                <div class="comment-body py-2 px-5 text-gray-800 hover:text-gray-600 rounded-lg block mt-8 ml-2 mr-0"
                                                style="background: #FF9999; width: 45%; min-width: 220px;">
                                                    <p class="comment-body-content whitespace-pre-wrap" id="comment">${data.comments[i].comment}</p>
                                                </div>
                                                <div class="flex flex-col">
                                                    <span class="comment-body-time text-xs ml-2 text-right mt-1" id="created_at">${created_at_format}</span>
                                                    <span class="text-xs ml-2 text-right">編集済 ${updated_at_time}</span>
                                                </div>
                                                <x-dropdown_ope align="right" width="48">
                                                    <x-slot name="trigger"><i class="fa-solid fa-feather-pointed mr-1"></i> 編集</x-slot>

                                                    <x-slot name="content">
                                                        <x-dropdown-link href="/chat/edit/${data.comments[i].id}" class="text-center"><i class="fa-solid fa-pen-to-square"></i> 変更</x-dropdown-link>
                                                        <form method="POST" action="/chat/remove/${data.comments[i].id}" class="mb-0">
                                                            @csrf
                                                            @method('delete')

                                                            <x-dropdown-link_delete onclick="return confirm('本当に削除してもよろしいですか？');">✘  削除</x-dropdown-link_delete>
                                                        </form>
                                                    </x-slot>
                                                </x-dropdown_ope>

                                            </div>
                                        </div>
                                    `;
                                } else if (updated_at_day === yesterday_format) {
                                    var html = `
                                        <div class="comment-visible block">
                                            <div class="media-body flex flex-col items-end">
                                                <div class="comment-body py-2 px-5 text-gray-800 hover:text-gray-600 rounded-lg block mt-8 ml-2 mr-0"
                                                style="background: #FF9999; width: 45%; min-width: 220px;">
                                                    <p class="comment-body-content whitespace-pre-wrap" id="comment">${data.comments[i].comment}</p>
                                                </div>
                                                <div class="flex flex-col">
                                                    <span class="comment-body-time text-xs ml-2 text-right mt-1" id="created_at">${created_at_format}</span>
                                                    <span class="text-xs ml-2 text-right">編集済 昨日${updated_at_time}</span>
                                                </div>
                                                <x-dropdown_ope align="right" width="48">
                                                    <x-slot name="trigger"><i class="fa-solid fa-feather-pointed mr-1"></i> 編集</x-slot>

                                                    <x-slot name="content">
                                                        <x-dropdown-link href="/chat/edit/${data.comments[i].id}" class="text-center"><i class="fa-solid fa-pen-to-square"></i> 変更</x-dropdown-link>
                                                        <form method="POST" action="/chat/remove/${data.comments[i].id}" class="mb-0">
                                                            @csrf
                                                            @method('delete')

                                                            <x-dropdown-link_delete onclick="return confirm('本当に削除してもよろしいですか？');">✘  削除</x-dropdown-link_delete>
                                                        </form>
                                                    </x-slot>
                                                </x-dropdown_ope>

                                            </div>
                                        </div>
                                    `;
                                } else {
                                    var html = `
                                        <div class="comment-visible block">
                                            <div class="media-body flex flex-col items-end">
                                                <div class="comment-body py-2 px-5 text-gray-800 hover:text-gray-600 rounded-lg block mt-8 ml-2 mr-0"
                                                style="background: #FF9999; width: 45%; min-width: 220px;">
                                                    <p class="comment-body-content whitespace-pre-wrap" id="comment">${data.comments[i].comment}</p>
                                                </div>
                                                <div class="flex flex-col">
                                                    <span class="comment-body-time text-xs ml-2 text-right mt-1" id="created_at">${created_at_format}</span>
                                                    <span class="text-xs ml-2 text-right">編集済 ${updated_at_format}</span>
                                                </div>
                                                <x-dropdown_ope align="right" width="48">
                                                    <x-slot name="trigger"><i class="fa-solid fa-feather-pointed mr-1"></i> 編集</x-slot>

                                                    <x-slot name="content">
                                                        <x-dropdown-link href="/chat/edit/${data.comments[i].id}" class="text-center"><i class="fa-solid fa-pen-to-square"></i> 変更</x-dropdown-link>
                                                        <form method="POST" action="/chat/remove/${data.comments[i].id}" class="mb-0">
                                                            @csrf
                                                            @method('delete')

                                                            <x-dropdown-link_delete onclick="return confirm('本当に削除してもよろしいですか？');">✘  削除</x-dropdown-link_delete>
                                                        </form>
                                                    </x-slot>
                                                </x-dropdown_ope>

                                            </div>
                                        </div>
                                    `;
                                }
                            }


                        } else {
                            // 編集をしていない場合
                            if (created_at_day === today_format) {
                                var html = `
                                    <div class="comment-visible block">
                                        <div class="media-body flex flex-col items-end">
                                            <div class="comment-body py-2 px-5 text-gray-800 hover:text-gray-600 rounded-lg block mt-8 ml-2 mr-0"
                                            style="background: #FF9999; width: 45%; min-width: 220px;">
                                                <p class="comment-body-content whitespace-pre-wrap" id="comment">${data.comments[i].comment}</p>
                                            </div>
                                            <div class="flex flex-col">
                                                <span class="comment-body-time text-xs ml-2 text-right mt-1" id="created_at">${created_at_time}</span>
                                            </div>
                                            <x-dropdown_ope align="right" width="48">
                                                <x-slot name="trigger"><i class="fa-solid fa-feather-pointed mr-1"></i> 編集</x-slot>

                                                <x-slot name="content">
                                                    <x-dropdown-link href="/chat/edit/${data.comments[i].id}" class="text-center"><i class="fa-solid fa-pen-to-square"></i> 変更</x-dropdown-link>
                                                    <form method="POST" action="/chat/remove/${data.comments[i].id}" class="mb-0">
                                                        @csrf
                                                        @method('delete')

                                                        <x-dropdown-link_delete onclick="return confirm('本当に削除してもよろしいですか？');">✘  削除</x-dropdown-link_delete>
                                                    </form>
                                                </x-slot>
                                            </x-dropdown_ope>

                                        </div>
                                    </div>
                                `;
                            } else if (created_at_day === yesterday_format) {
                                var html = `
                                    <div class="comment-visible block">
                                        <div class="media-body flex flex-col items-end">
                                            <div class="comment-body py-2 px-5 text-gray-800 hover:text-gray-600 rounded-lg block mt-8 ml-2 mr-0"
                                            style="background: #FF9999; width: 45%; min-width: 220px;">
                                                <p class="comment-body-content whitespace-pre-wrap" id="comment">${data.comments[i].comment}</p>
                                            </div>
                                            <div class="flex flex-col">
                                                <span class="comment-body-time text-xs ml-2 text-right mt-1" id="created_at">昨日${created_at_time}</span>
                                            </div>
                                            <x-dropdown_ope align="right" width="48">
                                                <x-slot name="trigger"><i class="fa-solid fa-feather-pointed mr-1"></i> 編集</x-slot>

                                                <x-slot name="content">
                                                    <x-dropdown-link href="/chat/edit/${data.comments[i].id}" class="text-center"><i class="fa-solid fa-pen-to-square"></i> 変更</x-dropdown-link>
                                                    <form method="POST" action="/chat/remove/${data.comments[i].id}" class="mb-0">
                                                        @csrf
                                                        @method('delete')

                                                        <x-dropdown-link_delete onclick="return confirm('本当に削除してもよろしいですか？');">✘  削除</x-dropdown-link_delete>
                                                    </form>
                                                </x-slot>
                                            </x-dropdown_ope>

                                        </div>
                                    </div>
                                `;
                            } else {
                                var html = `
                                    <div class="comment-visible block">
                                        <div class="media-body flex flex-col items-end">
                                            <div class="comment-body py-2 px-5 text-gray-800 hover:text-gray-600 rounded-lg block mt-8 ml-2 mr-0"
                                            style="background: #FF9999; width: 45%; min-width: 220px;">
                                                <p class="comment-body-content whitespace-pre-wrap" id="comment">${data.comments[i].comment}</p>
                                            </div>
                                            <div class="flex flex-col">
                                                <span class="comment-body-time text-xs ml-2 text-right mt-1" id="created_at">${created_at_format}</span>
                                            </div>
                                            <x-dropdown_ope align="right" width="48">
                                                <x-slot name="trigger"><i class="fa-solid fa-feather-pointed mr-1"></i> 編集</x-slot>

                                                <x-slot name="content">
                                                    <x-dropdown-link href="/chat/edit/${data.comments[i].id}" class="text-center"><i class="fa-solid fa-pen-to-square"></i> 変更</x-dropdown-link>
                                                    <form method="POST" action="/chat/remove/${data.comments[i].id}" class="mb-0">
                                                        @csrf
                                                        @method('delete')

                                                        <x-dropdown-link_delete onclick="return confirm('本当に削除してもよろしいですか？');">✘  削除</x-dropdown-link_delete>
                                                    </form>
                                                </x-slot>
                                            </x-dropdown_ope>

                                        </div>
                                    </div>
                                `;
                            }
                        }



                    } else {
                        // 相手のコメント

                        if (created_at_format !== updated_at_format) {
                            // 編集済の場合

                            if (created_at_day === today_format) {
                                // 今日に編集した場合
                                var html = `
                                    <div class="comment-visible block">
                                        <div class="media-body flex flex-col" style="width: 45%; min-width: 220px;">
                                            <div class="comment-body py-2 px-5 text-gray-800 hover:text-gray-600 rounded-lg block mt-8"
                                            style="background: #85E249;">
                                                <p class="comment-body-user font-bold text-sm" id="name">${data.comments[i].name}</p>
                                                <p class="comment-body-content whitespace-pre-wrap" id="comment">${data.comments[i].comment}</p>
                                            </div>
                                            <div class="flex flex-col">
                                                <span class="comment-body-time text-xs ml-2 text-right mt-1" id="created_at">${created_at_time}</span>
                                                <span class="text-xs ml-2 text-right">編集済 ${updated_at_time}</span>
                                            </div>

                                        </div>
                                    </div>
                                `;

                            } else if (created_at_day === yesterday_format) {
                                // 昨日に編集した場合
                                if (updated_at_day === today_format) {
                                    var html = `
                                        <div class="comment-visible block">
                                            <div class="media-body flex flex-col" style="width: 45%; min-width: 220px;">
                                                <div class="comment-body py-2 px-5 text-gray-800 hover:text-gray-600 rounded-lg block mt-8"
                                                style="background: #85E249;">
                                                    <p class="comment-body-user font-bold text-sm" id="name">${data.comments[i].name}</p>
                                                    <p class="comment-body-content whitespace-pre-wrap" id="comment">${data.comments[i].comment}</p>
                                                </div>
                                                <div class="flex flex-col">
                                                    <span class="comment-body-time text-xs ml-2 text-right mt-1" id="created_at">昨日${created_at_time}</span>
                                                    <span class="text-xs ml-2 text-right">編集済 ${updated_at_time}</span>
                                                </div>

                                            </div>
                                        </div>
                                    `;
                                } else {
                                    var html = `
                                    <div class="comment-visible block">
                                        <div class="media-body flex flex-col" style="width: 45%; min-width: 220px;">
                                            <div class="comment-body py-2 px-5 text-gray-800 hover:text-gray-600 rounded-lg block mt-8"
                                            style="background: #85E249;">
                                                <p class="comment-body-user font-bold text-sm" id="name">${data.comments[i].name}</p>
                                                <p class="comment-body-content whitespace-pre-wrap" id="comment">${data.comments[i].comment}</p>
                                            </div>
                                            <div class="flex flex-col">
                                                <span class="comment-body-time text-xs ml-2 text-right mt-1" id="created_at">昨日${created_at_time}</span>
                                                <span class="text-xs ml-2 text-right">編集済 昨日${updated_at_time}</span>
                                            </div>

                                        </div>
                                    </div>
                                `;
                                }

                            } else {
                                if (updated_at_day === today_format) {
                                    var html = `
                                        <div class="comment-visible block">
                                            <div class="media-body flex flex-col" style="width: 45%; min-width: 220px;">
                                                <div class="comment-body py-2 px-5 text-gray-800 hover:text-gray-600 rounded-lg block mt-8"
                                                style="background: #85E249;">
                                                    <p class="comment-body-user font-bold text-sm" id="name">${data.comments[i].name}</p>
                                                    <p class="comment-body-content whitespace-pre-wrap" id="comment">${data.comments[i].comment}</p>
                                                </div>
                                                <div class="flex flex-col">
                                                    <span class="comment-body-time text-xs ml-2 text-right mt-1" id="created_at">${created_at_format}</span>
                                                    <span class="text-xs ml-2 text-right">編集済 ${updated_at_time}</span>
                                                </div>

                                            </div>
                                        </div>
                                    `;
                                } else if (updated_at_day === yesterday_format) {
                                    var html = `
                                        <div class="comment-visible block">
                                            <div class="media-body flex flex-col" style="width: 45%; min-width: 220px;">
                                                <div class="comment-body py-2 px-5 text-gray-800 hover:text-gray-600 rounded-lg block mt-8"
                                                style="background: #85E249;">
                                                    <p class="comment-body-user font-bold text-sm" id="name">${data.comments[i].name}</p>
                                                    <p class="comment-body-content whitespace-pre-wrap" id="comment">${data.comments[i].comment}</p>
                                                </div>
                                                <div class="flex flex-col">
                                                    <span class="comment-body-time text-xs ml-2 text-right mt-1" id="created_at">${created_at_format}</span>
                                                    <span class="text-xs ml-2 text-right">編集済 昨日${updated_at_time}</span>
                                                </div>

                                            </div>
                                        </div>
                                    `;
                                } else {
                                    var html = `
                                        <div class="comment-visible block">
                                            <div class="media-body flex flex-col" style="width: 45%; min-width: 220px;">
                                                <div class="comment-body py-2 px-5 text-gray-800 hover:text-gray-600 rounded-lg block mt-8"
                                                style="background: #85E249;">
                                                    <p class="comment-body-user font-bold text-sm" id="name">${data.comments[i].name}</p>
                                                    <p class="comment-body-content whitespace-pre-wrap" id="comment">${data.comments[i].comment}</p>
                                                </div>
                                                <div class="flex flex-col">
                                                    <span class="comment-body-time text-xs ml-2 text-right mt-1" id="created_at">${created_at_format}</span>
                                                    <span class="text-xs ml-2 text-right">編集済 ${updated_at_format}</span>
                                                </div>

                                            </div>
                                        </div>
                                    `;
                                }
                            }


                        } else {
                            // 編集をしていない場合
                            if (created_at_day === today_format) {
                                var html = `
                                    <div class="comment-visible block">
                                        <div class="media-body flex flex-col" style="width: 45%; min-width: 220px;">
                                            <div class="comment-body py-2 px-5 text-gray-800 hover:text-gray-600 rounded-lg block mt-8"
                                            style="background: #85E249;">
                                                <p class="comment-body-user font-bold text-sm" id="name">${data.comments[i].name}</p>
                                                <p class="comment-body-content whitespace-pre-wrap" id="comment">${data.comments[i].comment}</p>
                                            </div>
                                            <div class="flex flex-col">
                                                <span class="comment-body-time text-xs ml-2 text-right mt-1" id="created_at">${created_at_time}</span>
                                            </div>

                                        </div>
                                    </div>
                                `;
                            } else if (created_at_day === yesterday_format) {
                                var html = `
                                    <div class="comment-visible block">
                                        <div class="media-body flex flex-col" style="width: 45%; min-width: 220px;">
                                            <div class="comment-body py-2 px-5 text-gray-800 hover:text-gray-600 rounded-lg block mt-8"
                                            style="background: #85E249;">
                                                <p class="comment-body-user font-bold text-sm" id="name">${data.comments[i].name}</p>
                                                <p class="comment-body-content whitespace-pre-wrap" id="comment">${data.comments[i].comment}</p>
                                            </div>
                                            <div class="flex flex-col">
                                                <span class="comment-body-time text-xs ml-2 text-right mt-1" id="created_at">昨日${created_at_time}</span>
                                            </div>

                                        </div>
                                    </div>
                                `;
                            } else {
                                var html = `
                                    <div class="comment-visible block">
                                        <div class="media-body flex flex-col" style="width: 45%; min-width: 220px;">
                                            <div class="comment-body py-2 px-5 text-gray-800 hover:text-gray-600 rounded-lg block mt-8"
                                            style="background: #85E249;">
                                                <p class="comment-body-user font-bold text-sm" id="name">${data.comments[i].name}</p>
                                                <p class="comment-body-content whitespace-pre-wrap" id="comment">${data.comments[i].comment}</p>
                                            </div>
                                            <div class="flex flex-col">
                                                <span class="comment-body-time text-xs ml-2 text-right mt-1" id="created_at">${created_at_format}</span>
                                            </div>

                                        </div>
                                    </div>
                                `;
                            }
                        }
                    }

                    $("#comment-data").append(html);


                    // スクロールを一番下に
                    let event = document.getElementById('submit');
                    let target = document.getElementById('comment-data');

                    event.addEventListener('click', function () {
                        target.scrollIntoView(false);
                    });


                    if (i === data.comments.length - 1) {
                        let target2 = document.querySelector('.card-body');
                        let lastComment = target.lastElementChild;
                        let commentsLength = window.sessionStorage.getItem(['commentsLength']);

                        let scrolly = target2.scrollTop;

                        if (scrolly === 0) {
                            target.scrollIntoView(false);
                        } else if (commentsLength == data.comments.length - 1) {
                            target.scrollIntoView(false);
                        }

                        let clientRect = lastComment.getBoundingClientRect();
                        let posy = clientRect.bottom;

                        window.sessionStorage.setItem(['commentsLength'],[data.comments.length]);
                    }


                }
            },
            error: () => {
                // alert("ajax Error");
            }
        });

        const timer = setTimeout("get_data()", 5000);
    }

</script>

@endsection
