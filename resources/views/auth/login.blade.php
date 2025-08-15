<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .text-yellow-custom {
            color: #facc15; /* amarillo fijo */
        }

        .text-yellow-custom:hover {
            color: #facc15; /* mantiene el amarillo al pasar el mouse */
        }

        .no-underline {
            text-decoration: none;
        }
    </style>
</head>
<body class="antialiased">

    <!-- Botón de regresar arriba a la izquierda -->
    <div class="absolute top-4 left-4 z-50">
        <a href="{{ route('home') }}" class="text-yellow-custom text-lg flex items-center space-x-1 no-underline">
            <span class="text-xl">←</span><span>Regresar</span>
        </a>
    </div>

    <div class="min-h-screen w-full flex items-center justify-center bg-no-repeat bg-cover bg-center"
         style="background-image: url('{{ asset('images/fonds.jpg') }}'); height: 100vh; position: fixed; top: 0; left: 0; right: 0; bottom: 0;">
        
        <!-- Formulario de Login con fondo transparente moderno -->
        <div class="backdrop-blur-md bg-white/10 p-8 rounded-xl shadow-2xl w-full max-w-sm text-white text-center">
            <h1 class="text-3xl font-bold text-yellow-300">Uaru-Sun</h1>
            <p class="text-yellow-200 mb-6">Conéctate con la Biodiversidad Hondureña</p>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div class="text-left">
                    <x-input-label for="email" :value="__('Correo')" class="text-yellow-300" />
                    <x-text-input id="email" class="block mt-1 w-full border-yellow-500 focus:border-yellow-700 
                        focus:ring focus:ring-yellow-300 text-gray-900" type="email" name="email" 
                        :value="old('email')" autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400" />
                </div>

                <!-- Password -->
                <div class="mt-4 text-left">
                    <x-input-label for="password" :value="__('Contraseña')" class="text-yellow-300" />
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
                        <span class="ms-2 text-sm text-yellow-300">{{ __('Guardar') }}</span>
                    </label>
                </div>

                <div class="flex items-center justify-between mt-4">
                    @if (Route::has('password.request'))
                        <a class="text-sm text-yellow-custom no-underline" href="{{ route('password.request') }}">
                            {{ __('¿Olvidaste tu Contraseña?') }}
                        </a>
                    @endif
                </div>

                <div class="flex flex-col items-center justify-center mt-6 space-y-4">
                    <x-primary-button class="bg-yellow-500 hover:bg-yellow-600 text-gray-900 px-4 py-2 rounded-lg shadow-md w-full">
                        {{ __('Iniciar sesión') }}
                    </x-primary-button>

                    <a href="{{ route('register') }}" class="text-sm text-yellow-custom no-underline">
                        {{ __('Registrarse') }}
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>

