@extends('layouts.base_chat')


@section('body')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight mt-16">
            {{ __('みんなでチャット') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 flex flex-col items-center">

                    <form action="{{ route('chat.update') }}" method="POST" class="w-full max-w-xl">
                        @csrf
                        @method('PATCH')

                        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                            <div class="px-4 py-5 sm:px-6">
                                <h3 class="text-lg leading-6 font-medium text-gray-900">コメント編集</h3>
                            </div>
                            <div class="border-t border-gray-200">
                                <input type="hidden" name="id" value="{{ $comment->id }}">
                                <dl>
                                    <div class="bg-white px-4 py-5">
                                        <dt class="text-sm font-medium text-gray-500 flex items-center">コメント（500文字以内）</dt>
                                        <div class="mt-1">
                                            <textarea id="comment" name="comment" rows="5" maxlength="500" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md">{{ old('comment', $comment->comment) }}</textarea>
                                            @error('comment')
                                            <div class="text-red-600">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </dl>
                            </div>
                        </div>

                        <div class="flex justify-center">
                            <a type="button" href="/chat" class="mt-6 mr-4 shadow bg-gray-500 hover:bg-gray-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded"><i class="fa-solid fa-circle-chevron-left"></i> 戻る</a>
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
