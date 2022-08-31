@extends('layouts.base_chat')


@section('body')
<x-app-layout>
    <x-slot name="header">
        <div class="flex mt-16">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight flex items-center whitespace-nowrap">
                {{ __('お問い合わせ内容確認') }}
            </h2>

        </div>
    </x-slot>


    {{-- flashメッセージを表示 --}}
    @if (session('status'))
        <x-ui.flash_message message="{{ session('status') }}"></x-ui.flash_message>
    @endif


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('confirm') }}" method="POST">
                        @csrf

                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        <input type="hidden" name="email" value="{{ $user->email }}">
                        <input type="hidden" name="room_id" value="{{ $user->room_id }}">
                        <input type="hidden" name="name" value="{{ $data->name }}">
                        <input type="hidden" name="category" value="{{ $data->category }}">
                        <input type="hidden" name="message" value="{{ $data->message }}">
                        <div class="shadow overflow-hidden sm:rounded-md">
                            <div class="px-4 py-5 bg-white sm:p-6">
                                <div class="grid grid-cols-6 gap-6">
                                    <div class="col-span-3">
                                        <label for="name" class="block text-sm font-medium text-gray-700">お名前</label>
                                        <p>{{ $data->name }}</p>
                                    </div>

                                    <div class="col-span-3"></div>

                                    <div class="col-span-3">
                                        <label for="category" class="block text-sm font-medium text-gray-700">お問い合わせ内容</label>
                                        <p>{{ $data->category }}</p>
                                    </div>

                                    <div class="col-span-6">
                                        <label for="message" class="block text-sm font-medium text-gray-700">お問い合わせ詳細（2000文字以内）</label>
                                        <p>{!! nl2br(e($data->message)) !!}</p>
                                    </div>

                                </div>
                            </div>
                            <div class="px-4 py-3 bg-gray-50 text-center sm:px-6">
                                <button type="submit" name="action" onclick="location.href='/contact'" class="mt-6 mr-4 shadow bg-gray-500 hover:bg-gray-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" value="back"><i class="fa-solid fa-circle-chevron-left"></i> 入力内容修正</button>
                                <button type="submit" name="action" class="py-2 px-4 border border-transparent shadow-sm text-md font-medium text-bold rounded-md text-white bg-orange-600 hover:bg-orange-700 focus:outline-none" value="submit"><img src="{{ asset('img/pngegg.png') }}" alt="送信" width="20" class="text-white inline-block relative bottom-0.5"> 送信する</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
@endsection

<div id="app"></div>
