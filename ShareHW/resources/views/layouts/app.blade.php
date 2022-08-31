<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Font Awesome -->
        <script src="https://kit.fontawesome.com/af52375bea.js" crossorigin="anonymous"></script>


        <!-- jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

        <!-- Lity  -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lity/2.4.1/lity.css" integrity="sha512-NDcw4w5Uk5nra1mdgmYYbghnm2azNRbxeI63fd3Zw72aYzFYdBGgODILLl1tHZezbC8Kep/Ep/civILr5nd1Qw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-{{ App\Models\UserColor::USER_COLOR_OBJECT[Auth::user()->color] }}-50">
            @include('layouts.navigation')

            <!-- Page Heading -->
            <header class="bg-{{ App\Models\UserColor::USER_COLOR_OBJECT[Auth::user()->color] }}-300 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>

            <!-- use color for the first time-->
            <div class="bg-orange-50"></div>
            <div class="bg-orange-300"></div>
            <div class="bg-red-50"></div>
            <div class="bg-red-300"></div>
            <div class="bg-pink-50"></div>
            <div class="bg-pink-300"></div>
            <div class="bg-yellow-50"></div>
            <div class="bg-yellow-300"></div>
            <div class="bg-blue-50"></div>
            <div class="bg-blue-300"></div>
            <div class="bg-sky-50"></div>
            <div class="bg-sky-300"></div>
            <div class="bg-teal-50"></div>
            <div class="bg-teal-300"></div>
            <div class="bg-purple-50"></div>
            <div class="bg-purple-300"></div>
            <div class="bg-green-50"></div>
            <div class="bg-green-300"></div>

            <!-- Page Content -->
            <main class="w-full">
                {{ $slot }}
                @yield('body')
            </main>
        </div>

        @yield('js')
        @yield('script')
    </body>
</html>
