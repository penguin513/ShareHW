@extends('layouts.base')

@section('body')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight mt-16">
            {{ __('我が家のアイテム') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                        <div class="px-4 py-5 sm:px-6">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">アイテム詳細</h3>
                        </div>
                        <div class="border-t border-gray-200">
                            <dl>
                                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">アイテム名</dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $item->name }}</dd>
                                </div>
                                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">写真</dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        @if (isset($item->photo))
                                        <img src="{{ \Storage::url($item->photo) }}" class="max-w-xs cursor-pointer" data-lity>
                                        @else
                                        <img src="{{ \Storage::url('/item_img/nothing_img.png') }}" class="max-w-xs cursor-pointer" data-lity>
                                        @endif
                                    </dd>
                                </div>
                                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">メッセージ</dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{!! nl2br(e($item->message)) !!}</dd>
                                </div>
                                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">カテゴリー</dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ App\Models\ItemCategory::ITEM_CATEGORY_OBJECT[$item->category] }}</dd>
                                </div>
                                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">追加購入</dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ App\Models\ItemRequired::ITEM_REQUIRED_OBJECT[$item->required] }}</dd>
                                </div>
                                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">作成日</dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ \Carbon\Carbon::parse($item->created_at)->format('Y年n月j日') }}</dd>
                                </div>
                            </dl>
                        </div>
                    </div>

                    <div class="hidden sm:block relative">
                        <div class="flex justify-center">
                            <button onclick="history.back()" class="mt-6 mr-4 shadow bg-gray-500 hover:bg-gray-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded"><i class="fa-solid fa-circle-chevron-left"></i> 戻る</button>
                            <button onclick="location.href='/items/edit/{{ $item->id }}'" class="mt-6 ml-2 shadow bg-orange-500 hover:bg-orange-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded"><i class="fa-solid fa-pen-to-square"></i> 変更</button>
                        </div>

                        <div class="absolute inset-y-0 right-0">
                            <form action="/items/remove/{{ $item->id }}" method="POST">
                                @csrf
                                @method('delete')
                                <button type="submit" onclick="return confirm('本当に削除してもよろしいですか？');" class="mt-6 mr-4 shadow bg-red-500 hover:bg-red-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded"><i class="fa-solid fa-trash-can"></i> 削除</button>
                            </form>
                        </div>
                    </div>


                    <div class="flex justify-center sm:hidden">
                        <button onclick="history.back()" class="mt-6 mr-4 shadow bg-gray-500 hover:bg-gray-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded"><i class="fa-solid fa-circle-chevron-left"></i> 戻る</button>

                        <button onclick="location.href='/items/edit/{{ $item->id }}'" class="mt-6 ml-2 shadow bg-orange-500 hover:bg-orange-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded"><i class="fa-solid fa-pen-to-square"></i> 変更</button>

                        <form action="/items/remove/{{ $item->id }}" method="POST" class="mt-6 mb-0 ml-6 shadow bg-red-500 hover:bg-red-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded">
                            @csrf
                            @method('delete')
                            <button type="submit" onclick="return confirm('本当に削除してもよろしいですか？');"><i class="fa-solid fa-trash-can"></i> 削除</button>
                        </form>
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
