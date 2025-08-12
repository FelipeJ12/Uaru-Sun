<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Restablecer contraseña</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        html, body {
            height: 100%;
            margin: 0;
        }
        body {
            background-image: url('{{ asset('images/fonds.jpg') }}');
            background-repeat: no-repeat;
            background-position: center center;
            background-size: cover;
            background-attachment: fixed;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
    </style>
</head>
<body>
    <!-- Botón en la esquina superior izquierda -->
    <div class="fixed top-4 left-4">
        <a href="{{ route('login') }}"
           class="inline-block px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-400 shadow-md">
            ← Ir atrás
        </a>
    </div>

    <div class="flex items-center justify-center min-h-screen px-4 py-12">
        <div class="bg-white bg-opacity-80 rounded-lg shadow-lg max-w-md w-full p-6">
            <p class="mb-6 text-green-900 text-center text-sm">
                ¿Olvidaste tu contraseña? No hay problema. Indícanos tu correo electrónico y te enviaremos un enlace para restablecerla.
            </p>

            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <label for="email" class="block mb-2 font-semibold text-green-800">Correo electrónico</label>
                <input
                    id="email"
                    type="email"
                    name="email"
                    required
                    autofocus
                    placeholder="ejemplo@correo.com"
                    class="w-full mb-4 px-4 py-2 border border-green-400 rounded focus:outline-none focus:ring-2 focus:ring-green-400 focus:border-green-600"
                >
                @error('email')
                    <p class="mb-4 text-red-600 text-sm">{{ $message }}</p>
                @enderror

                <button type="submit" class="w-full bg-green-700 hover:bg-green-800 text-white py-2 rounded focus:outline-none focus:ring-2 focus:ring-green-400">
                    Enviar enlace para restablecer contraseña
                </button>
            </form>
        </div>
    </div>
</body>
</html>
