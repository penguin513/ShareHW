@extends('layouts.base')


@section('body')
<x-app-layout>
    <x-slot name="header">
        <div class="flex mt-16">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight flex items-center">
                {{ __('ユーザ一覧') }}
            </h2>
        </div>
    </x-slot>


    {{-- flashメッセージを表示 --}}
    @if (session('status'))
        <x-ui.flash_message message="{{ session('status') }}"></x-ui.flash_message>
    @endif


    {{-- 検索機能 --}}
    <div class="pt-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-6">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="m-5">
                    <form action="{{ route('users') }}" method="GET">

                        <div class="flex-col md:flex-row flex flex-row">
                            <div class="col-span-6 sm:col-span-3 p-2 md:w-full lg:w-48 ">
                                <label for="name" class="block text-sm font-midium text-gray-700">ユーザ名</label>
                                <input type="text" name="name" id="name" value="{{ $name }}" class="mt-1 focus:ring-indego-500 focus:border-indigo block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>

                            <div class="col-span-6 sm:col-span-3 p-2 md:w-full lg:w-48">
                                <label for="email" class="block text-sm font-midium text-gray-700 whitespace-nowrap">メールアドレス</label>
                                <input type="text" name="email" id="email" value="{{ $email }}" class="mt-1 focus:ring-indego-500 focus:border-indigo block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>

                            <div class="p-2 md:w-full lg:w-48">
                                <label for="room_id" class="block text-sm font-midium text-gray-700">部屋ID</label>
                                <select name="room_id" id="room_id" value="{{ $room_id }}" class="mt-1 focus:ring-indego-500 focus:border-indigo block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    <option value="">--</option>
                                    @foreach($room_ids as $option)
                                        <option value="{{ $option }}" @if($room_id == $option) selected @endif >{{ $option }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="p-2 md:w-full lg:w-48">
                                <label for="area" class="block text-sm font-midium text-gray-700">エリア</label>
                                <select id="area" name="area" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    <option value="">--</option>
                                    @foreach (App\Models\UserArea::USER_AREA_OBJECT as $key => $value)
                                        <option value="{{ $key }}" @if ($area == $key) selected @endif>{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="p-2 md:w-full lg:w-48">
                                <label for="role" class="block text-sm font-midium text-gray-700">権限</label>
                                <select name="role" id="role" value="{{ $role }}" class="mt-1 focus:ring-indego-500 focus:border-indigo block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    <option value="">--</option>
                                    @foreach (App\Models\UserRole::USER_ROLE_OBJECT as $key => $value)
                                        <option value="{{ $key }}" @if ($role == $key) selected @endif>{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="p-2 md:w-full lg:w-48">
                                <label for="created_at" class="block text-sm font-midium text-gray-700">日付</label>
                                <input type="date" name="created_at" id="created_at" value="{{ $created_at }}" class="mt-1 focus:ring-indego-500 focus:border-indigo block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>

                            <div class="col-span-6 sm:col-span-3 p-2 md:w-full lg:w-48 relative mt-12">
                                <button type="submit" class="absolute inset-x-0 bottom-2 mr-2 shadow bg-blue-500 hover:bg-blue-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded-md whitespace-nowrap"><i class="fa-solid fa-magnifying-glass"></i> 検索</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    {{-- リスト --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <div class="py-12">
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                                <div class="p-6 bg-white border-b border-gray-200 overflow-x-scroll">
                                    <table class="table-auto w-full text-left whitespace-no-wrap">
                                        <thead>
                                            <tr>
                                                <th class="px-3 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl whitespace-nowrap">ID</th>
                                                <th class="px-3 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 whitespace-nowrap text-center">ユーザ名</th>
                                                <th class="px-3 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 whitespace-nowrap text-center">メールアドレス</th>
                                                <th class="px-3 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 whitespace-nowrap text-center">部屋ID</th>
                                                <th class="px-3 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 whitespace-nowrap text-center">エリア</th>
                                                <th class="px-3 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 whitespace-nowrap text-center">権限</th>
                                                <th class="px-3 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 whitespace-nowrap text-center">登録日</th>
                                                <th class="px-3 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 whitespace-nowrap text-center"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($users as $user)
                                                <tr class="border-t hover:bg-orange-50">
                                                    <td class="text-sm px-1 py-3 whitespace-nowrap text-center">{{ $user->id }}</td>
                                                    <td class="text-sm px-1 py-3 whitespace-nowrap text-center">{{ $user->name }}</td>
                                                    <td class="text-sm px-1 py-3">{{ $user->email }}</td>
                                                    <td class="text-sm px-1 py-3 text-gray-900 text-center">{{ $user->room_id }}</td>
                                                    <td class="text-sm px-1 py-3 text-center whitespace-nowrap text-center">
                                                        @if (isset($user->area))
                                                        {{ App\Models\UserArea::USER_AREA_OBJECT[$user->area] }}
                                                        @endif
                                                    </td>
                                                    <td class="text-sm px-2 py-3 text-center whitespace-nowrap text-center">{{ App\Models\UserRole::USER_ROLE_OBJECT[$user->role] }}</td>
                                                    <td class="text-sm px-3 py-3 text-center whitespace-nowrap text-center">{{ Carbon\Carbon::parse($user->created_at)->format('Y年n月j日') }}</td>
                                                    <td class="px-3 py-3 text-center whitespace-nowrap text-center ">
                                                        <button onclick="location.href='/users/detail/{{ $user->id }}'" class="text-xs shadow bg-gray-500 hover:bg-gray-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded my-1 w-full"><i class="fa-solid fa-circle-info"></i> 詳細</button>
                                                        <x-dropdown_ope align="right" width="48">
                                                            <x-slot name="trigger"><i class="fa-solid fa-feather-pointed mr-1"></i> 編集</x-slot>

                                                            <x-slot name="content">
                                                                <x-dropdown-link href="/users/edit/{{ $user->id }}"><i class="fa-solid fa-pen-to-square"></i> 変更</x-dropdown-link>
                                                                <form method="POST" action="{{ route('user.remove', $user->id) }}" class="mb-0">
                                                                    @csrf
                                                                    @method('delete')
                                                                    <x-dropdown-link_delete onclick="return confirm('本当に削除してもよろしいですか？');">✘  削除</x-dropdown-link_delete>
                                                                </form>
                                                            </x-slot>
                                                        </x-dropdown_ope>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                    {{ $users->appends(request()->input())->links() }}
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
@endsection

<div id="app"></div>
