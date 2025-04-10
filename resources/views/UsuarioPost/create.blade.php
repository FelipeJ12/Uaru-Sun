@extends('layouts.app')

@section('title', 'Nueva Especie')

@section('content')
<!-- Fondo de pantalla completo -->
<style>
    body {
        background: url('{{ asset('images/fonds.jpg') }}') no-repeat center center fixed;
        background-size: cover;
    }

    .content-box {
        background-color: rgba(255, 255, 255, 0.85); /* Fondo más suave y elegante */
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2); /* Sombra más suave */
        max-width: 800px;
        margin: 0 auto;
    }

    .form-label {
        font-weight: bold;
        color: #333;
    }

    .form-control {
        border-radius: 8px;
        border: 1px solid #ccc;
        padding: 10px;
        font-size: 16px;
    }

    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 8px rgba(0, 123, 255, 0.5);
    }

    .btn-primary {
        background-color: #4CAF50; /* Verde brillante */
        border-color: #4CAF50;
    }

    .btn-primary:hover {
        background-color: #45a049;
        border-color: #45a049;
    }

    .btn-secondary {
        background-color: #ccc;
        border-color: #ccc;
    }

    .btn-secondary:hover {
        background-color: #bbb;
        border-color: #bbb;
    }
</style>

<div class="container mt-4">
    <div class="content-box">
        <h1 class="text-center">Agregar Nueva Especie</h1>

        <form action="{{ route('UsuarioPost.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
        
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre Común</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
        
            <div class="mb-3">
                <label for="nombre_cientifico" class="form-label">Nombre Científico</label>
                <input type="text" class="form-control" id="nombre_cientifico" name="nombre_cientifico" required>
            </div>
        
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
            </div>
        
            <div class="mb-3">
                <label for="habitat" class="form-label">Hábitat</label>
                <textarea class="form-control" id="habitat" name="habitat" rows="2" required></textarea>
            </div>
        
            <div class="mb-3">
                <label for="location" class="form-label">Ubicación</label>
                <input type="text" class="form-control" id="location" name="location" required>
            </div>
        
            <div class="mb-3">
                <label for="category_id" class="form-label">Categoría</label>
                <select class="form-control" id="category_id" name="category_id" required>
                    <option value="" selected disabled>Seleccione una categoría</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->nombre }} ({{ $category->tipo }})</option>
                    @endforeach
                </select>
            </div>
        
            <div class="mb-3">
                <label for="image" class="form-label">Imagen</label>
                <input type="file" class="form-control" id="image" name="image" required accept="image/*">
            </div>
        
            <button type="submit" class="btn btn-primary">Guardar Publicacion</button>
            
            <a href="{{ route('UsuarioPost.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>

@endsection
