@extends('layouts.base')

@section('body')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight mt-16">
            {{ __('今日の家事') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <form action=" {{ route('housework.update') }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                            <div class="px-4 py-5 sm:px-6">
                                <h3 class="text-lg leading-6 font-medium text-gray-900">家事編集</h3>
                            </div>
                            <div class="border-t border-gray-200">
                                <input type="hidden" name="id" value="{{ $housework->id }}">
                                <input type="hidden" name="room_id" value="{{ $housework->room_id }}">
                                <input type="hidden" name="add_name" value="{{ $housework->add_name }}">
                                <dl>
                                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500 flex items-center">家事の名前</dt>
                                        <div class="mt-1">
                                            <input type="text" name="name" id="name" value="{{ old('name', $housework->name) }}" autocomplete="name" class="w-full mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-100 shadow-sm sm:text-sm border-gray-300 rounded-md">
                                            @error('name')
                                            <div class="text-red-600">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500 flex items-center">内容</dt>
                                        <div class="mt-1">
                                            <textarea id="message" name="message" rows="5" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md">{{ old('message', $housework->message) }}</textarea>
                                            @error('message')
                                            <div class="text-red-600">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500 flex items-center">家事ポイント</dt>
                                        <select id="point" name="point" autocomplete="point" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                            @for ($i = 1; $i <= 100; $i++)
                                                @if ($i%10 === 0)
                                                    <option value={{ $i }} @if($i === (int)old('point', $housework->point)) selected @endif>{{ $i }}pt</option>
                                                @endif
                                            @endfor
                                        </select>
                                        @error('point')
                                        <div class="text-red-600">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500 flex items-center">担当者</dt>
                                        <div class="mt-1">
                                            <select id="pic_name" name="pic_name" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                <option value="">--</option>
                                                @if ($user_role === 1)
                                                    @foreach($this_pic_members as $option)
                                                        <option value="{{ $option->name }}" @if ($option->name == old('pic_name', $housework->pic_name)) selected @endif>{{ $option->name }}</option>
                                                    @endforeach
                                                @endif
                                                @if ($user_role === 5)
                                                    @foreach($pic_names as $option)
                                                        <option value="{{ $option->name }}" @if ($option->name == old('pic_name', $housework->pic_name)) selected @endif>{{ $option->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            @error('pic_name')
                                            <div class="text-red-600">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500 flex items-center">進行状況</dt>
                                        <select id="status" name="status" autocomplete="status" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                            @foreach (App\Models\HouseworkStatus::HOMEWORK_STATUS_OBJECT as $key => $value)
                                                <option value="{{ $key }}" @if($key === (int)old('status', $housework->status)) selected @endif>{{ $value }}</option>
                                            @endforeach
                                        </select>
                                        @error('status')
                                            <div class="text-red-600">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500 flex items-center">作成日</dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ Carbon\Carbon::parse($housework->created_at)->format('Y年n月j日') }}</dd>
                                    </div>
                                </dl>
                            </div>
                        </div>

                        <div class="flex justify-center">
                            @php
                                $now = \Carbon\Carbon::now()->format('H');
                                if(4 > $now) {
                                    $today = \Carbon\Carbon::yesterday()->format('Y-m-d');
                                } else {
                                    $today = \Carbon\Carbon::now()->format('Y-m-d');
                                }
                            @endphp
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
