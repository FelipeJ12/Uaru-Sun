@extends('layouts.app')

@section('title', $product->name)

@section('content')
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>{{ $product->name }}</h1>
    </div>

    <div class="card shadow-lg p-4">
        <div class="d-flex justify-content-center mb-4">
            @if($product->image)
                <img src="{{ asset('images/' . $product->image) }}" 
                     alt="Imagen de {{ $product->name }}" 
                     style="width:566px; height:566px; object-fit:cover; border-radius:10px;">
            @else
                <div class="bg-gray-100 flex items-center justify-center text-gray-400 font-semibold" 
                     style="width:566px; height:566px; border-radius:10px;">
                    Sin imagen
                </div>
            @endif
        </div>

        <div class="card-body">
            <h4 class="card-title text-primary">Descripción</h4>
            <p>{{ $product->description }}</p>

            <h4 class="card-title text-success">Precio</h4>
            <p>L {{ number_format($product->price, 2) }}</p>

            <h4 class="card-title text-warning">Acciones</h4>
            <button 
                type="button" 
                class="btn btn-success"
                onclick="document.getElementById('confirmPanel').style.display = 'block';"
            >
                Agregar al carrito
            </button>

            <div id="confirmPanel" style="display:none; margin-top: 0.5rem; padding: 0.5rem; border: 2px solid #22c55e; border-radius: 8px; background-color: #e6f4ea; color: black;">
                <p style="color: red; font-size: 0.9rem;">¿Estás seguro de que deseas agregar este producto al carrito?</p>
                <div style="margin-top: 0.5rem; display: flex; justify-content: space-between;">
                    <button 
                        type="button" 
                        onclick="document.getElementById('confirmPanel').style.display = 'none';"
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

    <div class="mt-4">
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Volver a la lista de productos</a>
    </div>
</div>
@endsection
