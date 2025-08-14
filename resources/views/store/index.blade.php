@php
$items = [
    ['label' => 'Inicio', 'url' => route('home')],
    ['label' => 'Tienda']
];
$title = '🌿 Tienda de Flora Hondureña';
@endphp

@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 py-10 bg-gradient-to-b from-green-900 via-green-800 to-green-700 min-h-screen">

    <style>
        .product-card {
            width: 9cm;
            height: 14cm;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }
        .imagen-fija {
            width: 100%;
            height: 6.5cm;
            object-fit: cover;
        }
        .product-info {
            padding: 0.5rem;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .product-name {
            font-size: 1rem;
            font-weight: bold;
        }
        .product-description {
            font-size: 0.8rem;
            flex: 1;
            overflow: hidden;
        }
        .product-price {
            font-weight: bold;
            margin-top: 0.3rem;
        }
        .btn-add {
            background: #22c55e;
            color: white;
            padding: 0.4rem;
            border-radius: 8px;
            border: none;
            cursor: pointer;
        }
    </style>

    <!-- Contenedor de tarjetas centradas -->
    <div style="display: flex; flex-wrap: wrap; gap: 1rem; justify-content: center;">
        @foreach ($products as $product)
            <div class="product-card">
                @if($product->image)
                    <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}" class="imagen-fija" />
                @else
                    <div class="imagen-fija bg-gray-100 flex items-center justify-center text-gray-400 font-semibold rounded-t-2xl">
                        Sin imagen
                    </div>
                @endif

                <div class="product-info">
                    <h2 class="product-name">{{ $product->name }}</h2>
                    <p class="product-description">{{ $product->description }}</p>
                    <p class="product-price">L {{ number_format($product->price, 2) }}</p>

                    <button 
                        type="button" 
                        class="btn-add"
                        onclick="document.getElementById('confirmPanel-{{ $product->id }}').style.display = 'block';"
                    >
                        Agregar al carrito
                    </button>

                    <!-- Panel de confirmación -->
                    <div id="confirmPanel-{{ $product->id }}" style="display:none; margin-top: 0.5rem; padding: 0.5rem; border: 2px solid #22c55e; border-radius: 8px; background-color: #e6f4ea;">
                        <p style="color: red; font-size: 0.8rem;">¿Estás seguro de que deseas agregar este producto al carrito?</p>
                        <div style="margin-top: 0.5rem; display: flex; justify-content: space-between;">
                            <button 
                                type="button" 
                                onclick="document.getElementById('confirmPanel-{{ $product->id }}').style.display = 'none';"
                                style="background: #e5e7eb; border: none; padding: 0.3rem 0.6rem; border-radius: 6px; cursor: pointer; font-size: 0.8rem;"
                            >Cancelar</button>

                            <form action="{{ route('cart.add', $product->id) }}" method="POST" style="margin:0;">
                                @csrf
                                <button type="submit" style="background: #22c55e; color: white; border: none; padding: 0.3rem 0.6rem; border-radius: 6px; cursor: pointer; font-size: 0.8rem;">Agregar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection


