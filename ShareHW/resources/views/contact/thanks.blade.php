@extends('layouts.base_chat')


@section('body')
<x-app-layout>
    <x-slot name="header">
        <div class="flex mt-16">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight flex items-center whitespace-nowrap">
                {{ __('お問い合わせ完了') }}
            </h2>

        </div>
    </x-slot>


    {{-- flashメッセージを表示 --}}
    @if (session('status'))
        <x-ui.flash_message message="{{ session('status') }}"></x-ui.flash_message>
    @endif


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 text-center">
                    <h3 class="text-xl mb-3">お問い合わせいただきありがとうございます</h3>
                    <p>お問い合わせを受け付けました。<br>
                        受付メールをお送りしましたので、ご確認ください。<br>
                        受信フォルダにない場合は迷惑メールボックスにある場合があるため、ご確認ください。</p>
                    <button type="button" name="action" onclick="location.href='/contact'" class="mt-6 mr-4 shadow bg-gray-500 hover:bg-gray-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" value="back"><i class="fa-solid fa-circle-chevron-left"></i> お問い合わせトップに戻る</button>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
@endsection

<div id="app"></div>
