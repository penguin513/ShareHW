@extends('layouts.base')


@section('body')
<x-app-layout>
    <x-slot name="header">
        <div class="flex mt-16">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight flex items-center whitespace-nowrap">
                {{ __('お問い合わせ') }}
            </h2>

        </div>
    </x-slot>


    {{-- flashメッセージを表示 --}}
    @if (session('status'))
        <x-ui.flash_message_warning message="{{ session('status') }}"></x-ui.flash_message_warning>
    @endif


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <form action="{{ route('contact_send') }}" method="POST">
                        @csrf

                        <div class="shadow overflow-hidden sm:rounded-md">
                            <div class="px-4 py-5 bg-white sm:p-6">
                                <div class="grid grid-cols-6 gap-6">
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="name" class="block text-sm font-medium text-gray-700">お名前<span class="bg-red-500 text-white p-1 text-xs rounded-lg ml-2">{{ __('必須') }}</span></label>
                                        <input type="text" name="name" id="name" autocomplete="name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required value="{{ old('name', session('inputs')['name'] ?? '') }}">
                                        @error('name')
                                        <div class="text-red-600">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-span-3"></div>

                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="category" class="block text-sm font-medium text-gray-700">お問い合わせ内容<span class="bg-red-500 text-white p-1 text-xs rounded-lg ml-2">{{ __('必須') }}</span></label>
                                        <select id="category" name="category" autocomplete="category" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                                            <option value="">--</option>
                                            <option value="サービスについて" @if (old('category', session('inputs')['category'] ?? '') === 'サービスについて') selected @endif>サービスについて</option>
                                            <option value="プライバシーポリシーについて" @if (old('category', session('inputs')['category'] ?? '') === 'プライバシーポリシーについて') selected @endif>プライバシーポリシーについて</option>
                                            <option value="その他" @if (old('category', session('inputs')['category'] ?? '') === 'その他') selected @endif>その他</option>
                                        </select>
                                        @error('category')
                                        <div class="text-red-600">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-span-6">
                                        <label for="message" class="block text-sm font-medium text-gray-700">お問い合わせ詳細（2000文字以内）<span class="bg-red-500 text-white p-1 text-xs rounded-lg ml-2">{{ __('必須') }}</span></label>
                                        <textarea type="text" name="message" id="message" autocomplete="message" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" rows="10" maxlength="2000" required>{{ old('message', session('inputs')['message'] ?? '') }}</textarea>
                                        @error('message')
                                        <div class="text-red-600">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="agree_privacy col-span-6 flex flex-col items-center">
                                        <a href="/contact/privacy" class="text-blue-500 border-b border-blue-500 hover:text-blue-300 hover:border-blue-300" target="_blank" rel="noopener noreferrer">プライバシーポリシーを読む</a>
                                        <div class="flex items-center mt-3">
                                            <input type="checkbox" name="agree_privacy" id="agree" class="mr-2 cursor-pointer" value="" autocomplete="off" required="required" />
                                            <label for="agree" class="cursor-pointer"> プライバシーポリシーを確認し、同意しました</label>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="px-4 py-3 text-center sm:px-6">
                                <button type="submit" id="submit" class="mt-3 mb-6 ml-2 shadow bg-orange-500 hover:bg-orange-400 focus:shadow-outline focus:outline-none text-white disabled:opacity-25 font-bold py-2 px-4 rounded" readonly="readonly">入力内容の確認</button>
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

@section('script')
<script>
$(function() {
    $('#submit').prop('disabled', true);

    $('#agree').on('click', function() {
        if ($(this).prop('checked') == false) {
            $('#submit').prop('disabled', true);
        } else {
            $('#submit').prop('disabled', false);
        }
    });
});
</script>
@endsection
