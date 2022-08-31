<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {!! nl2br(__("パスワードのリセットをメールでご案内いたしますので、\nご登録済のメールアドレスを入力してください。\nメールが届かない場合は迷惑メールボックスをご確認の上、\nお手数ですがもう一度ご入力ください。")) !!}
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('メールアドレス')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm mr-5 text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                        {{ __('ログインはこちら') }}
                </a>

                <x-button>
                    {{ __('パスワードリセットのメールを送信する') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
