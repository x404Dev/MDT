<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4"
        :status="session('status')" />

    <form method="POST"
        action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        {{-- <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div> --}}
        <x-input-error :messages="$errors->get('email')"
            class="mt-2" />
        <x-input-error :messages="$errors->get('password')"
            class="mt-2" />
        <div class="input-group">
            <input type="email"
                required
                autofocus
                value="{{ old('email') }}"
                id="email"
                class="mdt-input"
                name="email"
                placeholder="Email">
        </div>

        <div class="input-group">
            <input type="password"
                required
                id="password"
                class="mdt-input"
                name="password"
                placeholder="Mot de Passe">
        </div>

        <!-- Password -->
        {{-- <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div> --}}

        <div class="flex items-center justify-end">
            <a class="gray-link"
                href="{{ route('register') }}">
                {{ __('Créer un compte') }}
            </a>

            <button class="btn white-btn ml-2">
                {{ __('Se connecter') }}
            </button>
        </div>
    </form>
</x-guest-layout>
