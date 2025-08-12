@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-12">

    <style>
        .text-center {
            margin-top: 80px;
        }

        .contenedor {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .informacion {
            width: 100%;
            max-width: 28%;
            margin-right: 20px;
            color: white;
        }

        .imagen-metodos {
            width: 150px;
            height: auto;
            margin-top: 10px;
        }

        .resumen-pago {
            width: 100%;
            max-width: 70%;
            background-color: white;
            border-radius: 16px;
            padding: 30px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        }

        .pago-btn {
            background-color: #38a169;
            color: white;
            font-weight: bold;
            padding: 12px 20px;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease, transform 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .pago-btn:hover {
            background-color: #2f855a;
            transform: translateY(-2px);
        }

        .volver-btn {
            background-color: #3182ce;
            color: white;
            font-weight: bold;
            padding: 12px 20px;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease, transform 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .volver-btn:hover {
            background-color: #2b6cb0;
            transform: translateY(-2px);
        }

        .btn-icon {
            font-size: 1.2rem;
        }

        .error-message {
            color: #dc2626; /* rojo para error */
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }

        @media (max-width: 768px) {
            .contenedor {
                flex-direction: column;
            }

            .informacion,
            .resumen-pago {
                max-width: 100%;
                margin-right: 0;
                margin-bottom: 30px;
            }
        }
    </style>

@php
    $items = [
        ['label' => 'Tienda', 'url' => \Illuminate\Support\Facades\Route::has('store.index') ? route('store.index') : url('/store')],
        ['label' => 'Carrito', 'url' => \Illuminate\Support\Facades\Route::has('cart.index') ? route('cart.index') : url('/cart')],
        ['label' => 'Estado de pago']
    ];
@endphp

<x-breadcrumbs :items="$items" title="Estado de pago" />

    <h1 class="text-4xl font-extrabold text-green-700 text-center mb-10" style="color: white;">Resumen del Pago</h1>

    <div class="contenedor">
        <div class="informacion">
            <h3 class="text-xl font-semibold mb-2">Opciones de pago seguro</h3>
            <p class="mb-4">Uaru Sun se compromete a proteger tu información de pago. Seguimos los estándares PCI DSS, utilizamos un encriptado sólido y realizamos revisiones periódicas del sistema para proteger tu privacidad.</p>
            <h4 class="font-bold">1. Métodos de pago</h4>
            <img src="{{ asset('images/pagos.jpeg') }}" alt="Métodos de Pago" class="imagen-metodos mb-4">
            <h4 class="font-bold">2. Certificación de seguridad</h4>
            <p class="mb-4">Proteger tu privacidad es muy importante para nosotros. Tus datos están en buenas manos.</p>
            <h4 class="font-bold">3. Protección de compras en Uaru Sun</h4>
            <p class="mb-4">Compra con confianza sabiendo que si algo sale mal, te respaldamos.</p>
            <h4 class="font-bold">4. Programa de plantación de árboles</h4>
            <p>Por cada compra que realizas, apoyas nuestro programa de reforestación.</p>
        </div>

        <div class="resumen-pago">
            @if (count($cart) > 0)
                <form method="POST" action="{{ route('checkout.procesarPago') }}" class="mb-6">
                    @csrf
                    <h3 class="text-xl font-semibold mb-4">Dirección de Envío</h3>

                    <div class="mb-4">
                        <label for="address" class="block font-medium mb-1">Calle y Número</label>
                        <input type="text" name="address" id="address" required
                            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" 
                            placeholder="Ejemplo: Avenida Siempre Viva 123"
                            value="{{ old('address') }}">
                        @error('address')
                            <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="city" class="block font-medium mb-1">Ciudad</label>
                            <input type="text" name="city" id="city" required
                                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500"
                                placeholder="Ciudad"
                                value="{{ old('city') }}">
                            @error('city')
                                <p class="error-message">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="state" class="block font-medium mb-1">Estado / Departamento</label>
                            <input type="text" name="state" id="state" required
                                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500"
                                placeholder="Estado o Departamento"
                                value="{{ old('state') }}">
                            @error('state')
                                <p class="error-message">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="postal_code" class="block font-medium mb-1">Código Postal</label>
                            <input type="text" name="postal_code" id="postal_code" required
                                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500"
                                placeholder="Código Postal"
                                value="{{ old('postal_code') }}">
                            @error('postal_code')
                                <p class="error-message">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="country" class="block font-medium mb-1">País</label>
                            <input type="text" name="country" id="country" required
                                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500"
                                placeholder="País"
                                value="{{ old('country') }}">
                            @error('country')
                                <p class="error-message">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <ul class="mb-6 divide-y divide-gray-200">
                        @foreach ($cart as $item)
                            <li class="flex justify-between items-center py-3">
                                <span class="text-gray-700 font-medium">{{ $item['name'] }} x{{ $item['quantity'] }}</span>
                                <span class="text-green-600 font-semibold">L {{ number_format($item['price'] * $item['quantity'], 2) }}</span>
                            </li>
                        @endforeach
                    </ul>

                    <div class="text-right text-2xl font-bold text-gray-800 mb-8">
                        Total: <span class="text-green-700">L {{ number_format($total, 2) }}</span>
                    </div>

                    <div class="flex flex-col md:flex-row gap-4">
                        <button type="submit" class="pago-btn w-full md:w-auto">
                            <i class="fas fa-credit-card btn-icon"></i> Confirmar y Pagar con Tarjeta
                        </button>

                        <a href="{{ route('store') }}" class="w-full md:w-auto">
                            <button type="button" class="volver-btn w-full">
                                <i class="fas fa-arrow-left btn-icon"></i> Volver a Tienda
                            </button>
                        </a>
                    </div>
                </form>
            @else
                <p class="text-center text-gray-500 text-lg">Tu carrito está vacío.</p>
            @endif
        </div>
    </div>
</div>
@endsection
