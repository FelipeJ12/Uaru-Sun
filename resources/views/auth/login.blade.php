<x-guest-layout>
    <div class="h-screen w-screen flex items-center justify-center bg-no-repeat bg-cover bg-center"
         style="background-image: url('{{ asset('images/fonds.jpg') }}');">
         
        <!-- Usamos un contenedor principal para que el fondo abarque toda la pantalla sin el cuadro limitado -->
        <div class="absolute inset-0 bg-no-repeat bg-cover bg-center"
             style="background-image: url('{{ asset('images/fonds.jpg') }}');"></div>
        
        <!-- Contenedor de contenido (sin el logo de Laravel) -->
        <div class="relative bg-opacity-80 bg-green-700 p-8 rounded-lg shadow-lg w-full max-w-sm text-white text-center">
            
            <h1 class="text-3xl font-bold text-yellow-300">Uaru-Sun</h1>
            <p class="text-yellow-200 mb-6">Conéctate con la Biodiversidad</p>
            
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf
                
                <!-- Email Address --> 
                <div class="text-left">
                    <x-input-label for="email" :value="__('Email')" class="text-yellow-300" />
                    <x-text-input id="email" class="block mt-1 w-full border-yellow-500 focus:border-yellow-700 
                        focus:ring focus:ring-yellow-300 text-gray-900" type="email" name="email" :value="old('email')" 
                        autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400" />
                </div>

                <!-- Password -->
                <div class="mt-4 text-left">
                    <x-input-label for="password" :value="__('Password')" class="text-yellow-300" />
                    <x-text-input id="password" class="block mt-1 w-full border-yellow-500 focus:border-yellow-700 
                        focus:ring focus:ring-yellow-300 text-gray-900" type="password" name="password" 
                        autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400" />
                </div>

                <!-- Remember Me -->
                <div class="block mt-4 text-left">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-yellow-500 text-yellow-600 
                            shadow-sm focus:ring-yellow-500" name="remember">
                        <span class="ms-2 text-sm text-yellow-300">{{ __('guardar') }}</span>
                    </label>
                </div>

                <div class="flex items-center justify-between mt-4">
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-yellow-300 hover:text-yellow-500" href="{{ route('password.request') }}">
                            {{ __('Olvidaste tu Contraseña?') }}
                        </a>
                    @endif
                </div>

                <div class="flex flex-col items-center justify-center mt-6 space-y-4">
                    <x-primary-button class="bg-yellow-500 hover:bg-yellow-600 text-gray-900 px-4 py-2 rounded-lg shadow-md w-full">
                        {{ __('Iniciar sesión') }}
                    </x-primary-button>
                    
                    <a href="{{ route('register') }}" class="text-sm text-yellow-300 hover:text-yellow-500 underline">
                        {{ __('Registrarse') }}
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
