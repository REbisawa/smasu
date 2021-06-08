<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('user.login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                <a class="ml-10 underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
                @endif
                <x-button class="ml-3">
                    {{ __('Log in') }}
                </x-button>
            </div>
        </form>
        <x-modal>
            <div class="m-0 p-5">
                <h2 class="text-lg pb-3">メールアドレス取得</h2>
                <p class="pb-1">
                    本サービスではLINEによる認証を利用し、認証ページにて許可を得た場合のみメールアドレスを取得します。
                </p>
                <p class="pb-1">
                    また、取得されたメールアドレスの利用目的に関して、以下に記します。
                </p>
                <ul class="list-none">
                    <li>
                        ・本サービスのログイン
                    </li>
                    <li>
                        ・本サービスの利用者様へのお知らせ通知
                    </li>
                </ul>
                <div class="text-center mt-5 inline-block">
                    <x-line-login></x-line-login>
                </div>
            </div>
        </x-modal>
    </x-auth-card>
</x-guest-layout>
