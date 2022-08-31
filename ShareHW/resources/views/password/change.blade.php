@extends('layouts.base')

@section('body')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight mt-16">
            {{ __('マイページ') }}
        </h2>
    </x-slot>


    {{-- flashメッセージを表示 --}}
    @if(session('warning'))
        <x-ui.flash_message_warning message="{{ session('warning') }}"></x-ui.flash_message_warning>
    @endif


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 flex flex-col items-center">

                    {!! Form::open(['route' => 'password.change', 'method' => 'put', 'class' => 'w-2/3 bg-white p-10']) !!}

                        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                            <div class="px-4 py-5 sm:px-6">
                                <h3 class="text-lg leading-6 font-medium text-gray-900">パスワード変更</h3>
                            </div>
                            <div class="border-t border-gray-200">
                                <dl>
                                    <div class="bg-gray-50 px-4 py-6 sm:gap-4 sm:px-6">
                                        {!! Form::label('current_password', '現在のパスワード') !!}
                                        <div class="mt-1">
                                            {!! Form::password('current_password' ,['class' => 'form-control mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-100 shadow-sm sm:text-sm border-gray-300 rounded-md w-full']) !!}
                                        </div>
                                    </div>
                                    <div class="bg-white px-4 py-6 sm:gap-4 sm:px-6">
                                        {!! Form::label('new_password', '新しいパスワード') !!}
                                        <div class="mt-1">
                                            {!! Form::password('new_password' ,['class' => 'form-control mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-100 shadow-sm sm:text-sm border-gray-300 rounded-md w-full']) !!}
                                        </div>
                                    </div>
                                    <div class="bg-gray-50 px-4 py-6 sm:grid sm:px-6">
                                        {!! Form::label('new_password_confirmation', 'パスワード確認') !!}
                                        <div class="mt-1">
                                            {!! Form::password('new_password_confirmation' ,['class' => 'form-control mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-100 shadow-sm sm:text-sm border-gray-300 rounded-md w-full']) !!}
                                        </div>
                                    </div>
                                </dl>
                            </div>
                        </div>

                        <div class="flex justify-center">
                            {!! Form::submit('パスワードを変更する', ['class' => 'shadow bg-orange-500 hover:bg-orange-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded cursor-pointer mt-10']) !!}
                        </div>
                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
@endsection

<div id="app"></div>
