@extends('layouts.base')

@section('body')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight mt-16">
            {{ __('マイページ') }}
        </h2>
    </x-slot>


    {{-- flashメッセージを表示 --}}
    @if (session('status'))
        <x-ui.flash_message message="{{ session('status') }}"></x-ui.flash_message>
    @endif


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">


                    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                        <div class="px-4 py-5 sm:px-6">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">ユーザ情報</h3>
                        </div>
                        <div class="border-t border-gray-200">
                            <dl>
                                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">ユーザ名</dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $user->name }}</dd>
                                </div>
                                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">メールアドレス</dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $user->email }}</dd>
                                </div>
                                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">部屋ID</dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $user->room_id }}</dd>
                                </div>
                                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">同部屋ユーザ一覧</dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        @php
                                            $index = 1;
                                        @endphp
                                        @foreach ($room_members as $room_member)
                                            <div class="flex items-center">
                                                <span>No.{{ $index }}</span><span class="ml-3 mr-1">{{ $room_member->name }}</span>さん
                                                @if ($room_member->id === $user->id)
                                                    <span class="p-1 ml-2 bg-red-500 text-white rounded-md">自分</span>
                                                @endif
                                            </div>

                                            @php
                                                $index = $index + 1;
                                            @endphp
                                            <br>
                                        @endforeach
                                    </dd>
                                </div>
                                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">エリア</dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        @if (isset($user->area))
                                        {{ App\Models\UserArea::USER_AREA_OBJECT[$user->area] }}
                                        @endif
                                    </dd>
                                </div>
                                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">画面カラー</dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        @switch(App\Models\UserColor::USER_COLOR_OBJECT[$user->color])
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
                                    </dd>
                                </div>
                                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">会員区分</dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        {{ App\Models\UserRole::USER_ROLE_OBJECT[$user->role] }}
                                    </dd>
                                </div>
                                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">ユーザ登録日</dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ \Carbon\Carbon::parse($user->created_at)->format('Y年n月j日') }}</dd>
                                </div>
                            </dl>
                        </div>
                    </div>

                    <div class="hidden sm:flex justify-center relative">
                        <button onclick="location.href='/mypage/edit/{{ $user->id }}'" class="mt-6 ml-2 shadow bg-orange-500 hover:bg-orange-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded"><i class="fa-solid fa-pen-to-square"></i> 変更する</button>

                        <div>
                            <a type="button" href="{{ route('mypage.withdrawal') }}" class="absolute bottom-0 right-0 mt-6 ml-2 shadow bg-red-500 hover:bg-red-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded"
                                onclick="return withdrawal()"><i class="fa-solid fa-door-open"></i> 退会する</a>

                            <form id="withdrawal-form" action="{{ route('mypage.withdrawal') }}" method="post" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>

                    <div class="flex sm:hidden justify-center">
                        <button onclick="location.href='/mypage/edit/{{ $user->id }}'" class="mt-6 mr-2 shadow bg-orange-500 hover:bg-orange-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded"><i class="fa-solid fa-pen-to-square"></i> 変更する</button>

                        <div>
                            <a type="button" href="{{ route('mypage.withdrawal') }}" class="mt-6 ml-2 shadow bg-red-500 hover:bg-red-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" onclick="return withdrawal()"><i class="fa-solid fa-door-open"></i> 退会する</a>

                            <form id="withdrawal-form" action="{{ route('mypage.withdrawal') }}" method="post" class="hidden">
                                @csrf
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
@endsection

<div id="app"></div>


@section('script')
<script>
    function withdrawal() {
        if (window.confirm('本当に退会しますか？')) {
            event.preventDefault();
            document.getElementById('withdrawal-form').submit();

        } else {
            return false;
        }
    }

</script>
@endsection
