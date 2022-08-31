@extends('layouts.base')


@section('body')
<x-app-layout>
    <x-slot name="header">
        <div class="flex mt-16">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight flex items-center">
                {{ __('マイページ') }}
            </h2>
        </div>
    </x-slot>


    {{-- flashメッセージを表示 --}}
    @if (session('status'))
        <x-ui.flash_message message="{{ session('status') }}"></x-ui.flash_message>
    @endif


    {{-- リスト --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <form action=" {{ route('mypage.update') }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <input type="hidden" name="id" value="{{ $user->id }}">
                        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                            <div class="px-4 py-5 sm:px-6">
                                <h3 class="text-lg leading-6 font-medium text-gray-900">ユーザ情報編集</h3>
                            </div>
                            <div class="border-t border-gray-200">
                                <dl>
                                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500 flex items-center">ユーザ名</dt>
                                        <div class="mt-1">
                                            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" autocomplete="name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-100 shadow-sm sm:text-sm border-gray-300 rounded-md w-full">
                                            @error('name')
                                            <div class="text-red-600">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500 flex items-center">メールアドレス</dt>
                                        <div class="mt-1">
                                            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" autocomplete="email" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-100 shadow-sm sm:text-sm border-gray-300 rounded-md w-full">
                                            @error('email')
                                            <div class="text-red-600">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500 flex items-center">部屋ID（半角数字12桁）</dt>
                                        <div class="mt-1">
                                            <input type="text" name="room_id" id="room_id" value="{{ old('room_id', $user->room_id) }}" autocomplete="room_id" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-100 shadow-sm sm:text-sm border-gray-300 rounded-md w-full">
                                            @error('room_id')
                                            <div class="text-red-600">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500 flex items-center">エリア</dt>
                                        <div class="mt-1">
                                            <select id="area" name="area" autocomplete="area" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                            <option value="">--</option>
                                            @foreach (App\Models\UserArea::USER_AREA_OBJECT as $key => $value)
                                                <option value="{{ $key }}" @if($key == (int)old('area', $user->area)) selected @endif>{{ $value }}</option>
                                            @endforeach
                                            </select>
                                            @error('area')
                                                <div class="text-red-600">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500 flex items-center">画面カラー</dt>
                                        <div class="mt-1">
                                            <select id="color" name="color" autocomplete="color" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                            @foreach (App\Models\UserColor::USER_COLOR_OBJECT as $key => $value)
                                                <option value="{{ $key }}" @if($key == (int)old('color', $user->color)) selected @endif>
                                                @switch($value)
                                                    @case('orange')
                                                        オレンジ(デフォルト)
                                                        @break
                                                    @case('red')
                                                        レッド
                                                        @break
                                                    @case('pink')
                                                        ピンク
                                                        @break
                                                    @case('yellow')
                                                        イエロー
                                                        @break
                                                    @case('blue')
                                                        ブルー
                                                        @break
                                                    @case('sky')
                                                        スカイブルー
                                                        @break
                                                    @case('teal')
                                                        ティールブルー
                                                        @break
                                                    @case('purple')
                                                        パープル
                                                        @break
                                                    @case('green')
                                                        グリーン
                                                        @break
                                                @endswitch
                                                </option>
                                            @endforeach
                                            </select>
                                            @error('color')
                                                <div class="text-red-600">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500 flex items-center">作成日</dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ Carbon\Carbon::parse($user->created_at)->format('Y年n月j日') }}</dd>
                                    </div>
                                </dl>
                            </div>
                        </div>

                        <div class="flex justify-center">
                            <a type="button" href="/mypage" class="mt-6 mr-4 shadow bg-gray-500 hover:bg-gray-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded whitespace-nowrap flex items-center"><i class="fa-solid fa-circle-chevron-left mr-1"></i>戻る</a>
                            <button type="button" onclick="location.href='/mypage/password/change'" class="mt-6 mx-5 shadow bg-blue-500 hover:bg-blue-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded"><i class="fa-solid fa-pen-to-square"></i> パスワードを変更する</button>
                            <button type="submit" class="mt-6 ml-2 shadow bg-orange-500 hover:bg-orange-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded whitespace-nowrap"><i class="fa-solid fa-arrow-rotate-right"></i> 更新</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
@endsection

<div id="app"></div>
