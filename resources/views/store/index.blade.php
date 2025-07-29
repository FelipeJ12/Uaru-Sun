@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-center text-green-700 mb-10">🌿 Tienda de Plantas de Honduras</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        @foreach ($products as $product)
            <div class="bg-white rounded-2xl shadow-md overflow-hidden transition transform hover:scale-105">
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}"
                         alt="{{ $product->name }}"
                         class="w-full h-48 object-cover">
                @else
                    <div class="w-full h-48 bg-gray-200 flex items-center justify-center text-gray-500">
                        Sin imagen
                    </div>
                @endif
                <div class="p-4">
                    <h2 class="text-xl font-semibold text-gray-800">{{ $product->name }}</h2>
                    <p class="text-sm text-gray-600 mt-1">{{ $product->description }}</p>
                    <p class="text-green-600 text-lg font-bold mt-2">L {{ number_format($product->price, 2) }}</p>

                    <form action="{{ route('cart.add', $product->id) }}" method="POST" class="mt-4"
                          onsubmit="return confirm('¿Estás seguro de que deseas agregar este producto al carrito?')">
                        @csrf
                        <button type="submit"
                            class="w-full bg-green-600 hover:bg-green-700 text-black font-semibold py-2 px-4 rounded-lg transition">
                            Agregar al carrito
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
