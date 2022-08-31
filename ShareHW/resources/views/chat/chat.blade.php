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


    <div class="chat-container flex justify-center w-100 fixed right-0 left-0">
        <div class="chat-area w-9/12 shadow-lg">
            <div class="card bg-white mt-0">
                <div class="card-header px-10 py-3 bg-gray-200">{{ $user->name }}さんのチャット</div>
                <div class="card-body chat-card overflow-auto p-5" style="height: calc(100vh - 360px);">

                    <div id="comment-data" class="media">
                        <div id="scroll_b" class="comment-visible block">

                            @foreach ($comments as $comment)
                                @if ($comment->user_id === $user->id)
                                    <div class="media-body flex flex-col items-end" >
                                        <div class="comment-body py-2 px-5 text-gray-800 hover:text-gray-500 rounded-lg block mt-8 ml-2 mr-0" style="background: rgb(255, 201, 201); width: 45%; min-width: 220px;">
                                            <p class="comment-body-user font-bold text-sm" id="name">{{ $comment->name }}</p>
                                            <p class="comment-body-content text-md" id="comment">{!! nl2br(e($comment->comment)) !!}</p>
                                        </div>
                                        <div class="flex flex-col">
                                            @if (Carbon\Carbon::parse($comment->created_at)->format('Y-m-d') === Carbon\Carbon::today()->format('Y-m-d'))
                                                <span class="comment-body-time text-xs ml-2 text-right text-gray-500" id="created_at">{{ Carbon\Carbon::parse($comment->created_at)->format('今日 H:i') }}</span>
                                            @elseif (Carbon\Carbon::parse($comment->created_at)->format('Y-m-d') === Carbon\Carbon::yesterday()->format('Y-m-d'))
                                                <span class="comment-body-time text-xs ml-2 text-right text-gray-500" id="created_at">{{ Carbon\Carbon::parse($comment->created_at)->format('昨日 H:i') }}</span>
                                            @else
                                                <span class="comment-body-time text-xs ml-2 text-right text-gray-500" id="created_at">{{ Carbon\Carbon::parse($comment->created_at)->format('n月j日 H:i') }}</span>
                                            @endif
                                            @if ($comment->created_at != $comment->updated_at)
                                                @if (Carbon\Carbon::parse($comment->updated_at)->format('Y-m-d') === Carbon\Carbon::today()->format('Y-m-d'))
                                                <span class="text-xs ml-2 text-right text-gray-500">編集済 {{ Carbon\Carbon::parse($comment->updated_at)->format('今日 H:i') }}</span>
                                                @elseif (Carbon\Carbon::parse($comment->updated_at)->format('Y-m-d') === Carbon\Carbon::yesterday()->format('Y-m-d'))
                                                    <span class="text-xs ml-2 text-right text-gray-500">編集済 {{ Carbon\Carbon::parse($comment->updated_at)->format('昨日 H:i') }}</span>
                                                @else
                                                    <span class="text-xs ml-2 text-right text-gray-500">編集済 {{ Carbon\Carbon::parse($comment->updated_at)->format('n月j日 H:i') }}</span>
                                                @endif
                                            @endif
                                        </div>
                                        <x-dropdown_ope align="right" width="48">
                                            <x-slot name="trigger"><i class="fa-solid fa-feather-pointed mr-1"></i> 編集</x-slot>

                                            <x-slot name="content">
                                                <x-dropdown-link href="/chat/edit/{{ $comment->id }}" class="text-center"><i class="fa-solid fa-pen-to-square"></i> 変更</x-dropdown-link>
                                                <form method="POST" action="{{ route('chat.remove', $comment->id) }}" class="mb-0">
                                                    @csrf
                                                    @method('delete')

                                                    <x-dropdown-link_delete onclick="return confirm('本当に削除してもよろしいですか？');">✘  削除</x-dropdown-link_delete>
                                                </form>
                                            </x-slot>
                                        </x-dropdown_ope>
                                    </div>

                                @else
                                    <div class="media-body flex flex-col">
                                        <div class="comment-body py-2 px-5 mt-8 text-gray-800 hover:text-gray-500 rounded-lg" style="background: #99ff99; width: 45%; min-width: 220px;">
                                            <p class="comment-body-user font-bold text-sm" id="name">{{ $comment->name }}</p>
                                            <p class="comment-body-content text-md" id="comment">{!! nl2br(e($comment->comment)) !!}</p>
                                        </div>
                                        <div class="flex flex-col" style="width: 45%; min-width: 220px;">
                                            @if (Carbon\Carbon::parse($comment->created_at)->format('Y-m-d') === Carbon\Carbon::today()->format('Y-m-d'))
                                                <p class="comment-body-time text-xs ml-2 text-start text-gray-500" id="created_at">{{ Carbon\Carbon::parse($comment->created_at)->format('今日 H:i') }}</p>
                                            @elseif (Carbon\Carbon::parse($comment->created_at)->format('Y-m-d') === Carbon\Carbon::yesterday()->format('Y-m-d'))
                                                <p class="comment-body-time text-xs ml-2 text-right text-gray-500" id="created_at">{{ Carbon\Carbon::parse($comment->created_at)->format('昨日 H:i') }}</p>
                                            @else
                                                <p class="comment-body-time text-xs ml-2 text-right text-gray-500" id="created_at">{{ Carbon\Carbon::parse($comment->created_at)->format('n月j日 H:i') }}</p>
                                            @endif
                                            @if ($comment->created_at != $comment->updated_at)
                                                @if (Carbon\Carbon::parse($comment->updated_at)->format('Y-m-d') === Carbon\Carbon::today()->format('Y-m-d'))
                                                <p class="text-xs ml-2 text-right text-gray-500">編集済 {{ Carbon\Carbon::parse($comment->updated_at)->format('今日 H:i') }}</p>
                                                @elseif (Carbon\Carbon::parse($comment->updated_at)->format('Y-m-d') === Carbon\Carbon::yesterday()->format('Y-m-d'))
                                                    <p class="text-xs ml-2 text-right text-gray-500">編集済 {{ Carbon\Carbon::parse($comment->updated_at)->format('昨日 H:i') }}</p>
                                                @else
                                                    <p class="text-xs ml-2 text-right text-gray-500">編集済 {{ Carbon\Carbon::parse($comment->updated_at)->format('n月j日 H:i') }}</p>
                                                @endif
                                            @endif
                                        </div>

                                    </div>
                                @endif
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <form method="POST" action="{{ route('add') }}">
        @csrf

        <div class="comment-container flex flex-col fixed items-center bottom-20 text-center w-full">
            <div class="input-group comment-area w-9/12 flex">
                <textarea class="form-control w-full rounded-md" id="comment" name="comment" placeholder="メッセージ送信 (ctrl + Enter)
※500文字以内"
                aria-label="With textarea"
                onkeydown="if (event.ctrlKey && event.keyCode==13) {document.getElementById('submit').click();return false};" row="5" required></textarea>
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
    let event = document.getElementById('submit');

    event.addEventListener('click', function() {
    let chatArea = document.getElementById('scroll_b'),
        chatAreaHeight = chatArea.scrollHeight;
        chatArea.scrollTop = chatAreaHeight;
    })

    window.addEventListener('DOMContentLoaded', ()=>{
        const target = document.getElementById('scroll_b');
        target.scrollIntoView(false);
    });
</script>
@endsection
