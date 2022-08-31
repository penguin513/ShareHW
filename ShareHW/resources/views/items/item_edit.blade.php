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

                    <form action=" {{ route('item.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                            <div class="px-4 py-5 sm:px-6">
                                <h3 class="text-lg leading-6 font-medium text-gray-900">アイテム編集</h3>
                            </div>
                            <div class="border-t border-gray-200">
                                <input type="hidden" name="id" value="{{ $item->id }}">
                                <input type="hidden" name="room_id" value="{{ $item->room_id }}">
                                <input type="hidden" name="add_name" value="{{ $item->add_name }}">
                                <dl>
                                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500 flex items-center">アイテム名</dt>
                                        <div class="mt-1">
                                            <input type="text" name="name" id="name" value="{{ old('name', $item->name) }}" autocomplete="name" class="w-full mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-100 shadow-sm sm:text-sm border-gray-300 rounded-md">
                                            @error('name')
                                            <div class="text-red-600">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500 flex items-center">
                                            写真
                                            <span class="ml-3 text-red-500">※jpg,jpeg,pngで3MB以内</span>
                                        </dt>
                                        <div class="mt-1">
                                            @if (isset($item->photo))
                                            <img src="{{ \Storage::url($item->photo) }}" class="max-w-xs">
                                            @else
                                            <img src="{{ \Storage::url('item_img/nothing_img.png') }}" class="max-w-xs">
                                            @endif
                                            <input type="file" name="photo" id="photo" value="{{ old('photo', $item->photo) }}" class="w-full mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-100 sm:text-sm border-gray-300 rounded-sm">
                                            @error('photo')
                                            <div class="text-red-600">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500 flex items-center">メッセージ</dt>
                                        <div class="mt-1">
                                            <textarea id="message" name="message" rows="5" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md">{{ old('message', $item->message) }}</textarea>
                                            @error('message')
                                            <div class="text-red-600">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500 flex items-center">カテゴリー</dt>
                                        <select id="category" name="category" autocomplete="category" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                            @foreach (App\Models\ItemCategory::ITEM_CATEGORY_OBJECT as $key => $value)
                                                <option value="{{ $key }}" @if($key === (int)old('category', $item->category)) selected @endif>{{ $value }}</option>
                                            @endforeach
                                        </select>
                                        @error('category')
                                        <div class="text-red-600">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500 flex items-center">追加購入</dt>
                                        <div class="mt-1">
                                            <select id="required" name="required" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                @foreach (App\Models\ItemRequired::ITEM_REQUIRED_OBJECT as $key => $value)
                                                <option value="{{ $key }}" @if($key === (int)old('required', $item->required)) selected @endif>{{ $value }}</option>
                                            @endforeach
                                            </select>
                                            @error('required')
                                            <div class="text-red-600">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500 flex items-center">追加日</dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ Carbon\Carbon::parse($item->created_at)->format('Y年n月j日') }}</dd>
                                    </div>
                                </dl>
                            </div>
                        </div>

                        <div class="flex justify-center">
                            <button type="button" onclick="history.back();" class="mt-6 mr-4 shadow bg-gray-500 hover:bg-gray-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded"><i class="fa-solid fa-circle-chevron-left"></i> 戻る</button>
                            <button type="submit" class="mt-6 ml-2 shadow bg-orange-500 hover:bg-orange-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded"><i class="fa-solid fa-arrow-rotate-right"></i> 更新</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
@endsection

<div id="app"></div>
