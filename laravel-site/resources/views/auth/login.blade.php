<x-login-layout>
    <x-auth.auth-card>
        <x-slot name="logo">
            <a href="{{ route('index') }}">
                <x-auth.application-logo class="fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Session Status -->
        <x-auth.auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth.auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-auth.label for="email" :value="__('Email')" />

                <x-auth.input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-auth.label for="password" :value="__('Password')" />

                <x-auth.input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-auth.button class="ml-3">
                    {{ __('Login') }}
                </x-auth.button>
            </div>
        </form>
    </x-auth.auth-card>
</x-login-layout>
