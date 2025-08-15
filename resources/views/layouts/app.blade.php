<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') | Flora y Fauna de Honduras</title>


    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">


    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Fuentes de Bunny -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Estilos compilados por Laravel Mix -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    @stack('styles')

    <style>
        body {
            background-image: url('{{ asset('images/fonds.jpg') }}');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            background-repeat: no-repeat;
        }

        .dropdown-menu {
            z-index: 1050 !important;
        }

        .container {
            max-width: 1200px;
            padding: 0 15px;
        }

        img {
            max-width: 100%;
            height: auto;
        }

        footer {
            background: rgba(0, 0, 0, 0.8);
            color: white;
            text-align: center;
            padding: 15px 0;
            font-size: 14px;
            width: 100%;
        }

        @media (max-width: 992px) {
            .navbar .form-select,
            .navbar .form-control {
                width: 100%;
                margin-top: 5px;
            }
        }

        @media (max-width: 767px) {
            .content {
                height: auto;
                padding: 20px;
            }
        }
    </style>

    @livewireStyles
</head>
<body class="font-sans antialiased d-flex flex-column min-vh-100">

<!-- Ícono local (funciona sin internet) -->
<link rel="stylesheet" href="{{ asset('css/all.min.css') }}">

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-success">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
        @include('layouts.navigation')
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
        }, 5000);
    </script>
@endif

<!-- Contenido Principal -->
<main class="py-4 flex-grow-1">
    <div class="container">

        {{-- Breadcrumbs globales --}}
        @if (View::hasSection('breadcrumbs'))
            @yield('breadcrumbs')
        @elseif (isset($items))
            <x-breadcrumbs :items="$items" :title="$title ?? null" />
        @elseif (!empty($autoBreadcrumbs))
            <x-breadcrumbs :items="$autoBreadcrumbs" :title="isset($title) ? $title : ''" />
        @endif

        @yield('content')
    </div>
</main>

<!-- Bootstrap JS -->
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
@stack('scripts')

<script>
    document.addEventListener("DOMContentLoaded", function () {
        var dropdownElementList = [].slice.call(document.querySelectorAll('.dropdown-toggle'));
        dropdownElementList.map(function (dropdownToggleEl) {
            new bootstrap.Dropdown(dropdownToggleEl);
        });
    });
</script>

<footer>
    Biodiversidad Hondureña.
</footer>

@livewireScripts
</body>
</html>
