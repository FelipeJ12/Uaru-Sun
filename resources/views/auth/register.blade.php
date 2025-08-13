<x-guest-layout>
    <div class="h-screen w-screen flex items-center justify-center bg-no-repeat bg-cover bg-center"
         style="background-image: url('{{ asset('images/fonds.jpg') }}');">
         
        <!-- Usamos un contenedor principal para que el fondo abarque toda la pantalla sin el cuadro limitado -->
        <div class="absolute inset-0 bg-no-repeat bg-cover bg-center"
             style="background-image: url('{{ asset('images/fonds.jpg') }}');"></div>
        
        <!-- Contenedor de contenido (sin el logo de Laravel) -->
        <div class="relative bg-opacity-80 bg-green-700 p-8 rounded-lg shadow-lg w-full max-w-sm text-white text-center">
            
            <h1 class="text-3xl font-bold text-yellow-300">Uaru-Sun</h1>
            <p class="text-yellow-200 mb-6">Únete a la biodiversidad</p>
            
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('register') }}">
                @csrf
                
                <!-- Name -->
                <div class="text-left">
                    <x-input-label for="name" :value="__('Nombre')" class="text-yellow-300" />
                    <x-text-input id="name" class="block mt-1 w-full border-yellow-500 focus:border-yellow-700 
                        focus:ring focus:ring-yellow-300 text-gray-900" type="text" name="name" :value="old('name')" 
                        required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-400" />
                </div>

                <!-- Email Address -->
                <div class="mt-4 text-left">
                    <x-input-label for="email" :value="__('Correo')" class="text-yellow-300" />
                    <x-text-input id="email" class="block mt-1 w-full border-yellow-500 focus:border-yellow-700 
                        focus:ring focus:ring-yellow-300 text-gray-900" type="email" name="email" :value="old('email')" 
                        required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400" />
                </div>

                <!-- Password -->
                <div class="mt-4 text-left">
                    <x-input-label for="password" :value="__('Contraseña')" class="text-yellow-300" />
                    <x-text-input id="password" class="block mt-1 w-full border-yellow-500 focus:border-yellow-700 
                        focus:ring focus:ring-yellow-300 text-gray-900" type="password" name="password" 
                        required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400" />
                </div>

                <!-- Confirm Password -->
                <div class="mt-4 text-left">
                    <x-input-label for="password_confirmation" :value="__('Confirmar Contraseña')" class="text-yellow-300" />
                    <x-text-input id="password_confirmation" class="block mt-1 w-full border-yellow-500 focus:border-yellow-700 
                        focus:ring focus:ring-yellow-300 text-gray-900" type="password" name="password_confirmation" 
                        required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-400" />
                </div>

                <div class="flex items-center justify-between mt-4">
                    <a class="underline text-sm text-yellow-300 hover:text-yellow-500" href="{{ route('login') }}">
                        {{ __('¿Ya tienes una cuenta? Inicia sesión') }}
                    </a>
                </div>

                <div class="flex flex-col items-center justify-center mt-6 space-y-4">
                    <x-primary-button class="bg-yellow-500 hover:bg-yellow-600 text-gray-900 px-4 py-2 rounded-lg shadow-md w-full">
                        {{ __('Registrarse') }}
                    </x-primary-button>
                    
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
