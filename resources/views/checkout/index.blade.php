@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-12">

<style>
        .text-center {
            margin-top: 80px;
        }
    </style>

    <div class="text-center mb-4">
    <h1 class="text-4xl font-extrabold text-green-700" style="color: white">Resumen del Pago</h1>
    </div>

    
    <div class="bg-white rounded-2xl shadow-xl p-8 max-w-2xl mx-auto">
        @if (count($cart) > 0)
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

            {{-- Botones lado a lado --}}
            <div class="flex flex-col md:flex-row gap-4">
                {{-- Botón de pago --}}
                <form action="{{ route('checkout.stripe') }}" method="POST" class="w-full">
                    @csrf
                    <button type="submit"
                            class="w-full bg-green-600 hover:bg-green-700 transition duration-200  font-semibold py-3 rounded-xl shadow">
                        Confirmar y Pagar con Tarjeta
                    </button>
                </form>

                {{-- Botón para regresar a la tienda --}}
                <a href="{{ route('store') }}" class="w-full">
                    <button type="button"
                            class="w-full bg-blue-500 hover:bg-blue-600 transition duration-200  font-semibold py-3 rounded-xl shadow">
                        Volver a Tienda
                    </button>
                </a>
            </div>
        @else
            <p class="text-center text-gray-500 text-lg">Tu carrito está vacío.</p>
        @endif
    </div>
</div>
@endsection
