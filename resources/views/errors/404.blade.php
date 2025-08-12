{{-- resources/views/errors/404.blade.php --}}
@extends('layouts.app')

@section('title', 'Página no encontrada')

@section('content')
<style>
    .error-container {
        position: relative;
        height: 80vh;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        color: white;
        text-align: center;
        background: url('{{ asset("images/bosque.jpg") }}') center/cover no-repeat;
    }

    .error-container h1 {
        font-size: 150px;
        font-weight: bold;
        color: #28a745;
        animation: pulse 1.5s infinite;
        text-shadow: 2px 2px 6px rgba(0,0,0,0.6);
    }

    .error-container h2 {
        font-size: 28px;
        margin-bottom: 15px;
        text-shadow: 1px 1px 5px rgba(0,0,0,0.6);
    }

    .error-container p {
        font-size: 18px;
        color: #f0f0f0;
        max-width: 500px;
        margin-bottom: 30px;
        text-shadow: 1px 1px 5px rgba(0,0,0,0.6);
    }

    .error-container a {
        background: #28a745;
        color: white;
        padding: 12px 25px;
        border-radius: 25px;
        font-size: 16px;
        text-decoration: none;
        transition: all 0.3s ease;
        box-shadow: 2px 2px 8px rgba(0,0,0,0.3);
    }

    .error-container a:hover {
        background: #218838;
        transform: scale(1.05);
    }

    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.05); }
        100% { transform: scale(1); }
    }
</style>

<div class="error-container">
    <h1>404</h1>
    <h2>Oops 😢 La página que buscas no existe</h2>
    <p>Es posible que el enlace esté roto o que la página haya sido movida.</p>
    <a href="{{ url('/') }}">Volver al inicio</a>
</div>
@endsection
