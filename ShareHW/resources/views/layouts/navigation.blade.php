<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 fixed right-0 left-0 z-50 shadow-2xl">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    @php
                        $now = \Carbon\Carbon::now()->format('H');
                        if(4 > $now) {
                            $today = \Carbon\Carbon::yesterday()->format('Y-m-d');
                            $today_of_week = \Carbon\Carbon::yesterday()->dayOfWeekIso;
                        } else {
                            $today = \Carbon\Carbon::now()->format('Y-m-d');
                            $today_of_week = \Carbon\Carbon::now()->dayOfWeekIso;
                        }
                    @endphp
                    <a href="/houseworks?created_at={{ $today }}">
                        <x-application-logo class="block h-10 w-auto fill-current text-gray-600" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link href="/houseworks?created_at={{ $today }}" :active="request()->routeIs('houseworks')">
                        {{ __('今日の家事') }}
                    </x-nav-link>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link href="/houseworks/schedule" :active="request()->routeIs('schedules')">
                        {{ __('家事スケジュール') }}
                    </x-nav-link>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link href="/items" :active="request()->routeIs('items')">
                        {{ __('我が家のアイテム') }}
                    </x-nav-link>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link href="/chat" :active="request()->routeIs('chat')">
                        {{ __('みんなでチャット') }}
                    </x-nav-link>
                </div>

                @php
                    $role = Auth::user()->role;
                @endphp
                @if ($role === 1)
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <x-nav-link href="/users" :active="request()->routeIs('users')">
                            {{ __('ユーザ一覧') }}
                        </x-nav-link>
                    </div>
                @endif
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                            @if ($role === 1)
                                <span class="p-1 bg-blue-500 rounded-md text-white mr-2">管理者</span>
                            @else
                                <span class="p-1 bg-green-500 rounded-md text-white mr-2">一般</span>
                            @endif
                            <div class="text-md">ようこそ<span class="px-2 text-lg text-gray-800">{{ Auth::user()->name }}</span>さん</div>

                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <form method="POST" action="{{ route('logout') }}" class="mb-0">
                            @csrf

                            <x-dropdown-link href="/mypage" :active="request()->routeIs('mypage')">
                                {{ __('マイページ') }}
                            </x-dropdown-link>
                            <x-dropdown-link href="/contact" :active="request()->routeIs('contact')">
                                {{ __('お問い合わせ') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('ログアウト') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link href="/houseworks?created_at={{ $today }}" :active="request()->routeIs('houseworks')">
                {{ __('今日の家事') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link href="/houseworks/schedule" :active="request()->routeIs('schedules')">
                {{ __('家事スケジュール') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('items')" :active="request()->routeIs('items')">
                {{ __('我が家のアイテム') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link href="/chat" :active="request()->routeIs('chat')">
                {{ __('みんなでチャット') }}
            </x-responsive-nav-link>
            @if ($role === 1)
            <x-responsive-nav-link :href="route('users')" :active="request()->routeIs('users')">
                {{ __('ユーザ一覧') }}
            </x-responsive-nav-link>
            @endif
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                @if ($role === 1)
                    <span class="p-1 bg-blue-500 rounded-md text-white">管理者</span>
                @else
                    <span class="p-1 bg-green-500 rounded-md text-white">一般</span>
                @endif
                <div class="font-medium text-md text-gray-800">ようこそ<span class="px-2 text-lg text-gray-800">{{ Auth::user()->name }}</span>さん</span></div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <form method="POST" action="{{ route('logout') }}" class="mb-0">
                    @csrf

                    <x-responsive-nav-link href="/mypage" :active="request()->routeIs('mypage')">
                                {{ __('マイページ') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link href="/contact" :active="request()->routeIs('contact')">
                                {{ __('お問い合わせ') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('ログアウト') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
