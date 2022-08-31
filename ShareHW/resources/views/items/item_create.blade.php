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

                    <form action=" {{ route('item.create') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                            <div class="px-4 py-5 sm:px-6">
                                <h3 class="text-lg leading-6 font-medium text-gray-900">新規アイテム追加</h3>
                            </div>
                            <div class="border-t border-gray-200">
                                <input type="hidden" name="room_id" value="{{ $user->room_id }}">
                                <input type="hidden" name="add_name" value="{{ $user->name }}">
                                <dl>
                                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500 flex items-center">アイテム名<span class="bg-red-500 text-white p-1 text-xs rounded-lg ml-2">{{ __('必須') }}</span></dt>
                                        <div class="mt-1">
                                            <input type="text" name="name" id="name" value="{{ old('name') }}" autocomplete="name" class="w-full mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-100 shadow-sm sm:text-sm border-gray-300 rounded-md">
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
                                            <input type="file" name="photo" id="photo" value="{{ old('photo') }}" autocomplete="photo" class="w-full mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-100 sm:text-sm border-gray-300 rounded-sm">
                                            @error('photo')
                                            <div class="text-red-600">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500 flex items-center">メッセージ</dt>
                                        <div class="mt-1">
                                            <textarea id="message" name="message" rows="5" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md">{{ old('message') }}</textarea>
                                            @error('message')
                                            <div class="text-red-600">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500 flex items-center">カテゴリー</dt>
                                        <div class="mt-1">
                                            <select id="category" name="category" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                @foreach (App\Models\ItemCategory::ITEM_CATEGORY_OBJECT as $key => $value)
                                                    <option value="{{ $key }}" @if($key === (int)old('category')) selected @endif>{{ $value }}</option>
                                                @endforeach
                                            </select>
                                            @error('category')
                                            <div class="text-red-600">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500 flex items-center">追加購入<span class="bg-red-500 text-white p-1 text-xs rounded-lg ml-2">{{ __('必須') }}</span></dt>
                                        <div class="mt-1">
                                            <select id="required" name="required" autocomplete="required" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                @foreach (App\Models\ItemRequired::ITEM_REQUIRED_OBJECT as $key => $value)
                                                    <option value="{{ $key }}" @if($key === (int)old('required')) selected @endif>{{ $value }}</option>
                                                @endforeach
                                            </select>
                                            @error('required')
                                                <div class="text-red-600">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                </dl>
                            </div>
                        </div>

                        <div class="flex justify-center">
                            <button type="button" onclick="history.back();" class="mt-6 mr-4 shadow bg-gray-500 hover:bg-gray-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded"><i class="fa-solid fa-circle-chevron-left"></i> 戻る</button>
                            <button type="submit" class="mt-6 ml-2 shadow bg-blue-500 hover:bg-blue-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded"><i class="fa-regular fa-square-plus"></i> 新規作成</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
@endsection

<div id="app"></div>
