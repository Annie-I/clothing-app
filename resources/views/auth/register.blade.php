<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- First Name -->
            <div>
                <x-label for="firstName" :value="__('Vārds')" />

                <x-input id="firstName" class="block mt-1 w-full" type="text" name="firstName" :value="old('firstName')" required autofocus />
            </div>

            
            <!-- Last Name -->
            <div class="mt-4">
                <x-label for="lastName" :value="__('Uzvārds')" />

                <x-input id="lastName" class="block mt-1 w-full" type="text" name="lastName" :value="old('lastName')" required />
            </div>

            <!-- Birth Date -->
            <div class="mt-4">
                <x-label for="birthDate" :value="__('Dzimšanas datums')" />

                <x-input id="birthDate" class="block mt-1 w-full" type="date" name="birthDate" :value="old('birthDate')" required />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('E-pasts')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Parole')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Parole atkārtoti')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
