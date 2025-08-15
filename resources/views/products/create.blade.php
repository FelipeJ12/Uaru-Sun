@php
$items = [
    ['label' => 'Inicio', 'url' => route('home')],
    ['label' => 'Tienda', 'url' => route('products.index')],
    ['label' => isset($product) ? 'Editar Producto' : 'Nuevo Producto']
];
$title = isset($product) ? 'Editar Producto' : 'Agregar Nuevo Producto';
@endphp

@extends('layouts.app')

@section('title', $title)

@section('content')
<style>
body {
    background: url('{{ asset('images/fonds.jpg') }}') no-repeat center center fixed;
    background-size: cover;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.form-container {
    max-width: 700px;
    background: rgba(30, 28, 28, 0.85);
    padding: 30px 40px;
    border-radius: 15px;
    box-shadow: 0 8px 24px rgba(0,0,0,0.4);
    margin: 40px auto;
    color: white;
}

h1 {
    text-align: center;
    margin-bottom: 30px;
    font-weight: 700;
    color: #81c784;
    text-shadow: 1px 1px 4px #000;
}

label {
    font-weight: 600;
    margin-bottom: 8px;
    display: block;
    color: #b5e7a0;
}

input[type="text"],
input[type="number"],
textarea,
input[type="file"] {
    width: 100%;
    padding: 10px 14px;
    border-radius: 12px;
    border: 1.5px solid #2e7d32;
    background-color: rgba(255, 255, 255, 0.9);
    color: #1b5e20;
    font-size: 1rem;
    transition: border-color 0.3s ease;
    resize: vertical;
}

input:focus, textarea:focus, input[type="file"]:focus {
    outline: none;
    border-color: #81c784;
    box-shadow: 0 0 8px #81c784;
}

textarea { min-height: 100px; }

.btn-custom {
    background: linear-gradient(135deg, #16a34a, #15803d);
    color: white;
    border: none;
    padding: 12px 25px;
    font-size: 1.1rem;
    font-weight: 700;
    border-radius: 9999px;
    cursor: pointer;
    box-shadow: 0 6px 15px rgba(22, 163, 74, 0.4);
    transition: background 0.3s ease, transform 0.2s ease;
    margin-top: 10px;
    display: inline-flex;
    align-items: center;
    gap: 8px;
}

.btn-custom:hover { background: linear-gradient(135deg, #15803d, #166534); transform: scale(1.05); }
.btn-custom:active { transform: scale(0.95); box-shadow: none; }

.btn-secondary-custom {
    background: #4a4a4a;
    color: #ccc;
    border: none;
    padding: 12px 25px;
    font-size: 1.1rem;
    font-weight: 600;
    border-radius: 9999px;
    cursor: pointer;
    box-shadow: 0 4px 10px rgba(0,0,0,0.3);
    transition: background 0.3s ease, color 0.3s ease;
    margin-top: 10px;
    text-align: center;
    display: inline-block;
    text-decoration: none;
}

.btn-secondary-custom:hover { background: #6b6b6b; color: white; }
.btn-secondary-custom:active { transform: scale(0.95); }

.btn-group {
    display: flex;
    justify-content: space-between;
    gap: 15px;
    margin-top: 20px;
    flex-wrap: wrap;
}

.btn-group > * { flex: 1 1 45%; text-align: center; }

@media (max-width: 576px) {
    .btn-group > * { flex: 1 1 100%; }
}

.text-danger {
    font-size: 0.9rem;
    color: #f44336;
    margin-top: 5px;
    display: none;
}

.is-invalid {
    border-color: #f44336 !important;
    box-shadow: 0 0 8px #f44336 !important;
}

#preview img {
    max-width: 100%;
    max-height: 250px;
    margin-top: 15px;
    border-radius: 15px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.5);
    object-fit: cover;
    display: block;
}
</style>

<div class="form-container">
    <h1>{{ isset($product) ? 'Editar Producto' : 'Agregar Nuevo Producto' }}</h1>

    <form id="productoForm" action="{{ isset($product) ? route('products.update', $product->id) : route('products.store') }}" method="POST" enctype="multipart/form-data" novalidate>
        @csrf
        @if(isset($product)) @method('PUT') @endif

        <div class="mb-3">
            <label for="name">Nombre</label>
            <input type="text" id="name" name="name" maxlength="50" value="{{ old('name', $product->name ?? '') }}" required oninput="validarNombre()">
            <div id="nameError" class="text-danger">El nombre debe tener al menos 2 caracteres.</div>
        </div>

        <div class="mb-3">
            <label for="description">Descripción</label>
            <textarea id="description" name="description" rows="3" required oninput="validarDescripcion()">{{ old('description', $product->description ?? '') }}</textarea>
            <div id="descriptionError" class="text-danger">La descripción debe tener al menos 5 caracteres.</div>
        </div>

        <div class="mb-3">
            <label for="price">Precio</label>
            <input type="number" step="0.01" id="price" name="price" value="{{ old('price', $product->price ?? '') }}" required oninput="validarPrecio()">
            <div id="priceError" class="text-danger">Debe ingresar un precio válido.</div>
        </div>

        <div class="mb-3">
            <label for="image">Imagen</label>
            <input type="file" id="image" name="image" accept="image/*" {{ isset($product) ? '' : 'required' }} onchange="validarImagen()">
            <div id="imageError" class="text-danger">Debe subir una imagen válida.</div>
            <div id="preview">
                @if(isset($product) && $product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" alt="Vista previa de la imagen">
                @endif
            </div>
        </div>

        <div class="btn-group">
            <a href="{{ route('products.index') }}" class="btn-secondary-custom">Cancelar</a>
            <button type="submit" class="btn-custom">
                <span id="guardarIcono"><i class="fas fa-save"></i></span>
                {{ isset($product) ? 'Actualizar' : 'Guardar' }}
            </button>
        </div>
    </form>
</div>

<script>
function validarNombre() {
    const input = document.getElementById('name');
    const error = document.getElementById('nameError');
    const valido = input.value.trim().length >= 2;
    error.style.display = valido ? 'none' : 'block';
    input.classList.toggle('is-invalid', !valido);
}

function validarDescripcion() {
    const input = document.getElementById('description');
    const error = document.getElementById('descriptionError');
    const valido = input.value.trim().length >= 5;
    error.style.display = valido ? 'none' : 'block';
    input.classList.toggle('is-invalid', !valido);
}

function validarPrecio() {
    const input = document.getElementById('price');
    const error = document.getElementById('priceError');
    const valido = parseFloat(input.value) > 0;
    error.style.display = valido ? 'none' : 'block';
    input.classList.toggle('is-invalid', !valido);
}

function validarImagen() {
    const input = document.getElementById('image');
    const error = document.getElementById('imageError');
    const preview = document.getElementById('preview');
    const file = input.files[0];

    if (file && file.type.startsWith('image/')) {
        error.style.display = 'none';
        input.classList.remove('is-invalid');

        const reader = new FileReader();
        reader.onload = function(e) {
            preview.innerHTML = `<img src="${e.target.result}" alt="Vista previa de la imagen">`;
        }
        reader.readAsDataURL(file);
    } else {
        error.style.display = 'block';
        input.classList.add('is-invalid');
        preview.innerHTML = '';
    }
}

document.getElementById('productoForm').addEventListener('submit', function(event) {
    validarNombre();
    validarDescripcion();
    validarPrecio();
    validarImagen();

    const errores = document.querySelectorAll('.is-invalid');
    if (errores.length > 0) {
        event.preventDefault();
        event.stopPropagation();
    }
});
</script>
@endsection
