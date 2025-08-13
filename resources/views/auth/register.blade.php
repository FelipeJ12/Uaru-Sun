<x-guest-layout>
    <div class="min-h-screen w-full flex items-center justify-center bg-no-repeat bg-cover bg-center"
         style="background-image: url('{{ asset('images/fonds.jpg') }}'); height: 100vh; position: fixed; top: 0; left: 0; right: 0; bottom: 0;">

        <div class="backdrop-blur-md bg-white/10 p-8 rounded-xl shadow-2xl w-full max-w-sm text-white text-center">
            <h1 class="text-3xl font-bold text-yellow-300">Uaru-Sun</h1>
            <p class="text-yellow-200 mb-6">Únete a la biodiversidad</p>

            <!-- Estado de la sesión -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Nombre -->
                <div class="text-left">
                    <x-input-label for="name" :value="__('Nombre')" class="text-yellow-300" />
                    <x-text-input id="name"
                        class="block mt-1 w-full border-yellow-500 focus:border-yellow-700 focus:ring focus:ring-yellow-300 text-gray-900"
                        type="text" name="name" :value="old('name')" required autofocus autocomplete="name"
                        maxlength="100"
                        title="El nombre no debe exceder los 100 caracteres." />
                    <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-400" />
                </div>

                <!-- Correo electrónico -->
                <div class="mt-4 text-left">
                    <x-input-label for="email" :value="__('Correo electrónico')" class="text-yellow-300" />
                    <x-text-input id="email"
                        class="block mt-1 w-full border-yellow-500 focus:border-yellow-700 focus:ring focus:ring-yellow-300 text-gray-900"
                        type="email" name="email" :value="old('email')" required autocomplete="username"
                        maxlength="100"
                        title="El correo no debe exceder los 100 caracteres." />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400" />
                </div>

                <!-- Contraseña -->
                <div class="mt-4 text-left">
                    <x-input-label for="password" :value="__('Contraseña (mínimo 8 caracteres)')" class="text-yellow-300" />
                    <x-text-input id="password"
                        class="block mt-1 w-full border-yellow-500 focus:border-yellow-700 focus:ring focus:ring-yellow-300 text-gray-900"
                        type="password" name="password" required autocomplete="new-password" minlength="8" maxlength="20"
                        title="La contraseña debe tener entre 8 y 20 caracteres." />
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400" />
                </div>

                <!-- Confirmar contraseña -->
                <div class="mt-4 text-left">
                    <x-input-label for="password_confirmation" :value="__('Confirmar contraseña')" class="text-yellow-300" />
                    <x-text-input id="password_confirmation"
                        class="block mt-1 w-full border-yellow-500 focus:border-yellow-700 focus:ring focus:ring-yellow-300 text-gray-900"
                        type="password" name="password_confirmation" required autocomplete="new-password" minlength="8" maxlength="20"
                        title="Debe coincidir con la contraseña." />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-400" />
                </div>

                <div class="flex items-center justify-between mt-4">
                    <a class="no-underline text-sm text-yellow-300 hover:text-yellow-500" href="{{ route('login') }}">
                        {{ __('¿Ya tienes una cuenta? Inicia sesión') }}
                    </a>
                </div>

                <div class="flex flex-col items-center justify-center mt-6 space-y-4">
                    <x-primary-button
                        class="bg-yellow-500 hover:bg-yellow-600 text-gray-900 px-4 py-2 rounded-lg shadow-md w-full">
                        {{ __('Registrarse') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>