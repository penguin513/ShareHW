@extends('layouts.base')


@section('body')
<x-app-layout>
    <x-slot name="header">
        <div class="flex mt-16">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight flex items-center">
                {{ __('我が家のアイテム') }}
            </h2>
            <button onclick="location.href='/items/new'" class="text-base ml-5 shadow bg-blue-500 hover:bg-blue-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded"><i class="fa-regular fa-square-plus"></i> 新規作成</button>
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
                    <form action="{{ route('items') }}" method="GET">

                        <div class="flex-col md:flex-row flex flex-row justify-center">
                            @if ($user_role === 1)
                            <div class="col-span-6 sm:col-span-3 p-2 md:w-full lg:w-48 ">
                                <label for="name" class="block text-sm font-midium text-gray-700">部屋ID</label>
                                <select id="room_id" name="room_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    <option value="">--</option>
                                    @foreach($room_ids as $option)
                                        <option value="{{ $option }}" @if($room_id == $option) selected @endif >{{ $option }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @endif

                            <div class="col-span-6 sm:col-span-3 p-2 md:w-full lg:w-48 ">
                                <label for="name" class="block text-sm font-midium text-gray-700">アイテム名</label>
                                <input type="text" name="name" id="name" value="{{ $name }}" class="mt-1 focus:ring-indego-500 focus:border-indigo block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>

                            <div class="col-span-6 sm:col-span-3 p-2 md:w-full lg:w-48">
                                <label for="message" class="block text-sm font-midium text-gray-700">メッセージ</label>
                                <input type="text" name="message" id="message" value="{{ $message }}" class="mt-1 focus:ring-indego-500 focus:border-indigo block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>

                            <div class="p-2 md:w-full lg:w-48">
                                <label for="category" class="block text-sm font-midium text-gray-700">カテゴリー</label>
                                <select id="category" name="category" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    <option value="">--</option>
                                    @foreach (App\Models\ItemCategory::ITEM_CATEGORY_OBJECT as $key => $value)
                                        <option value="{{ $key }}" @if ($category == $key) selected @endif>{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="p-2 md:w-full lg:w-48">
                                <label for="required" class="block text-sm font-midium text-gray-700">追加購入</label>
                                <select id="required" name="required" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    <option value="">--</option>
                                    @foreach (App\Models\ItemRequired::ITEM_REQUIRED_OBJECT as $key => $value)
                                        <option value="{{ $key }}" @if ($required == $key) selected @endif>{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="p-2 md:w-full lg:w-48">
                                <label for="created_at" class="block text-sm font-midium text-gray-700">追加日</label>
                                <input type="date" name="created_at" id="created_at" value="{{ $created_at }}" class="mt-1 focus:ring-indego-500 focus:border-indigo block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>

                            <div class="col-span-6 sm:col-span-3 p-2 md:w-full lg:w-48 relative mt-12">
                                <button type="submit" class="absolute inset-x-0 bottom-2 mr-2 shadow bg-blue-500 hover:bg-blue-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded-md"><i class="fa-solid fa-magnifying-glass whitespace-nowrap"></i> 検索</button>
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
                                                <th class="px-3 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 whitespace-nowrap text-center">ID</th>
                                                <th class="px-3 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 whitespace-nowrap text-center">部屋ID</th>
                                                <th class="px-3 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 whitespace-nowrap text-center">アイテム名</th>
                                                <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 whitespace-nowrap text-center">写真</th>
                                                <th class="px-1 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 whitespace-nowrap text-center">メッセージ</th>
                                                <th class="px-2 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 whitespace-nowrap text-center">カテゴリー</th>
                                                <th class="px-2 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 whitespace-nowrap text-center">追加購入</th>
                                                <th class="px-3 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 whitespace-nowrap text-center">追加日</th>
                                                <th class="px-3 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 whitespace-nowrap text-center"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($items as $item)
                                                <tr  class="border-t hover:bg-orange-50">
                                                    <td class="text-sm px-3 py-3 whitespace-nowrap text-center">{{ $item->id }}</td>
                                                    <td class="text-sm px-3 py-3 whitespace-nowrap text-center">{{ $item->room_id }}</td>
                                                    <td class="text-sm px-3 py-3 whitespace-nowrap text-center">{{ $item->name }}</td>
                                                    <td class="max-w-xs max-h-xs px-1 py-3 text-gray-900 text-center">
                                                        @if (isset($item->photo))
                                                        <img src="{{ \Storage::url($item->photo) }}" class="cursor-pointer" data-lity>
                                                        @else
                                                        <img src="{{ \Storage::url('/item_img/nothing_img.png') }}">
                                                        @endif
                                                    </td>
                                                    <td class="text-sm px-4 py-3">{{ Str::limit($item->message, 50, $end="...") }}</td>
                                                    <td class="text-sm px-2 w-10 text-center whitespace-nowrap text-center">{{ App\Models\ItemCategory::ITEM_CATEGORY_OBJECT[$item->category] }}</td>
                                                    <td class="text-sm px-2 w-10 text-center whitespace-nowrap text-center">{{ App\Models\ItemRequired::ITEM_REQUIRED_OBJECT[$item->required] }}</td>
                                                    <td class="text-sm px-3 w-10 text-center whitespace-nowrap text-center">{{ Carbon\Carbon::parse($item->created_at)->format('Y年n月j日') }}</td>
                                                    <td class="px-3 w-10 text-center whitespace-nowrap text-center ">
                                                        <button onclick="location.href='/items/detail/{{ $item->id }}'" class="text-xs shadow bg-gray-500 hover:bg-gray-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded my-1"><i class="fa-solid fa-circle-info"></i> 詳細</button>
                                                        <x-dropdown_ope align="right" width="48">
                                                            <x-slot name="trigger"><i class="fa-solid fa-feather-pointed mr-1"></i>編集</x-slot>

                                                            <x-slot name="content">
                                                                <x-dropdown-link href="/items/edit/{{ $item->id }}"><i class="fa-solid fa-pen-to-square"></i> 変更</x-dropdown-link>
                                                                <form method="POST" action="{{ route('item.remove', $item->id) }}" class="mb-0">
                                                                    @csrf
                                                                    @method('delete')
                                                                    <x-dropdown-link_delete onclick="return confirm('本当に削除してもよろしいですか？');">✘ 削除</x-dropdown-link_delete>
                                                                </form>
                                                            </x-slot>
                                                        </x-dropdown_ope>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                    {{ $items->appends(request()->input())->links() }}
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


@section('script')
<script src="https://code.jquery.com/jquery-3.6.0.slim.js" integrity="sha256-HwWONEZrpuoh951cQD1ov2HUK5zA5DwJ1DNUXaM6FsY=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lity/2.4.1/lity.min.js" integrity="sha512-UU0D/t+4/SgJpOeBYkY+lG16MaNF8aqmermRIz8dlmQhOlBnw6iQrnt4Ijty513WB3w+q4JO75IX03lDj6qQNA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection
