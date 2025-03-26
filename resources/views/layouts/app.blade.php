<!DOCTYPE html>
<html lang="es">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') | Flora y Fauna de Honduras</title>

    <!-- Bootstrap 5 desde CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Fuentes de Breeze (opcional) -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @stack('styles')

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Fondo de la página */
        body {
            background-image: url('images/fonds.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            background-repeat: no-repeat;
        }

        /* Contenido encima del fondo */
        .content {
            position: relative;
            z-index: 1;
            text-align: center;
            color: white;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: rgba(0, 0, 0, 0.3);
        }

        /* Asegura que los dropdowns sean visibles */
        .dropdown-menu {
            z-index: 1050 !important;
        }

        /* Asegurar que los contenedores sean responsivos */
        .container {
            width: 100%;
            max-width: 1200px; /* Limita el tamaño máximo del contenedor */
            padding: 0 15px; /* Agrega padding para márgenes en pantallas pequeñas */
        }

        /* Hacer las imágenes responsivas */
        img {
            max-width: 100%;
            height: auto;
        }

        /* Ajustes adicionales para pantallas pequeñas */
        @media (max-width: 767px) {
            .content {
                height: auto; /* El contenido no ocupará toda la altura en móviles */
                padding: 20px;
            }
        }
    </style>
</head>
<body class="font-sans antialiased">
    <!-- Navbar de Bootstrap -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-success">
        <div class="container">
            <a class="navbar-brand" href="/">Biodiversidad HN</a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                @include('layouts.navigation')
            </div>
        </div>
    </nav>

    <!-- Contenido Principal -->
    <main class="py-4">
        <div class="container">
            @yield('content')
        </div>
    </main>

    <footer class="bg-dark text-white mt-5">
        <div class="container py-4">
            <p class="mb-0 text-center">&copy; {{ date('Y') }} Biodiversidad Hondureña</p>
        </div>
    </footer>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
    
    <!-- Script para inicializar dropdowns -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var dropdownElementList = [].slice.call(document.querySelectorAll('.dropdown-toggle'));
            dropdownElementList.map(function (dropdownToggleEl) {
                new bootstrap.Dropdown(dropdownToggleEl);
            });
        });
    </script>
</body>
</html>
