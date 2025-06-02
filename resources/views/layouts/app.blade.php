<!DOCTYPE html>
<html lang="es">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') | Flora y Fauna de Honduras</title>

    {{-- IMPORTAR FONT AWESOME PARA ÍCONOS --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Agregar favicon -->
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    <!-- Bootstrap 5 desde CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-papPjXvSxQy2tc+tdBO9e8z6mZ3KD+uHr1vwMDxQqnlG4EOGvD9B8FJ+ElZ6KkX5IewvOd3FY2NwlHbfe2E3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <!-- Fuentes de Breeze (opcional) -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @stack('styles')

    <style>
        @media (max-width: 992px) {
        .navbar .form-select,
        .navbar .form-control {
        width: 100%;
        margin-top: 5px;
        }
    }
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
            max-width: 1200px;
            padding: 0 15px;
        }

        /* Hacer las imágenes responsivas */
        img {
            max-width: 100%;
            height: auto;
        }

        /* Ajustes adicionales para pantallas pequeñas */
        @media (max-width: 767px) {
            .content {
                height: auto;
                padding: 20px;
            }
        }
        footer {
        background: rgba(0, 0, 0, 0.8);
        color: white;
        text-align: center;
        padding: 15px 0;
        font-size: 14px;
        width: 100%;
    }
    </style>
</head>
<body class="font-sans antialiased d-flex flex-column min-vh-100">
    <!-- Navbar de Bootstrap -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-success">
    @include('layouts.navigation')  <!-- Menú de Breeze modificado -->
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                @include('layouts.navigation')
            </div>
        </div>
    </nav>

    <!-- Mensaje flash -->
    @if (session('success'))
        <div id="success-message" class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
        <script>
            setTimeout(function() {
                document.getElementById('success-message').style.display = 'none';
            }, 5000);  // El mensaje desaparecerá después de 5 segundos
        </script>
    @endif

    <!-- Contenido Principal -->
    <main class="py-4 flex-grow-1">
        <div class="container">
            @yield('content')
        </div>
    </main>
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
    <footer>
     {{ ('') }} Biodiversidad Hondureña.
</footer>
</body>

</html>
