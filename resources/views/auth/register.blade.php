<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        {{-- <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div> --}}
        <x-input-error :messages="$errors->get('key')"
            class="mt-2" />
        <x-input-error :messages="$errors->get('name')"
            class="mt-2" />
        <x-input-error :messages="$errors->get('email')"
            class="mt-2" />
        <x-input-error :messages="$errors->get('password')"
            class="mt-2" />
        <x-input-error :messages="$errors->get('password_confirmation')"
            class="mt-2" />
        <div class="input-group">
            <input type="text"
                required
                autofocus
                value="{{ old('key') }}"
                id="key"
                class="mdt-input"
                name="key"
                placeholder="Clé">
        </div>
        <div class="input-group">
            <input type="text"
                required
                value="{{ old('name') }}"
                id="name"
                class="mdt-input"
                name="name"
                placeholder="Nom">
        </div>

        <!-- Email Address -->
        {{-- <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div> --}}
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

        <!-- Password -->
        {{-- <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div> --}}
        <div class="input-group">
            <input type="password"
                required
                id="password"
                class="mdt-input"
                name="password"
                autocomplete="new-password"
                placeholder="Mot de Passe">
        </div>

        <!-- Confirm Password -->
        {{-- <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div> --}}
        <div class="input-group">
            <input type="password"
                required
                id="password_confirmation"
                class="mdt-input"
                name="password_confirmation"
                placeholder="Confirmer le Mot de Passe">
        </div>

        <div class="flex items-center justify-end">
            <a class="gray-link"
                href="{{ route('login') }}">
                {{ __('Se connecter') }}
            </a>

            <button class="btn white-btn ml-2">
                {{ __('Créer le compte') }}
            </button>
        </div>
    </form>
</x-guest-layout>
