@extends('layouts.app')

@section('title', 'Editar Especie')

@section('content')
<style>
    body {
        background: url('{{ asset('images/fonds.jpg') }}') no-repeat center center fixed;
        background-size: cover;
        font-family: 'Segoe UI', sans-serif;
    }

    .edit-form-container {
        background-color: rgba(255, 255, 255, 0.6); /* Más transparente */
        padding: 30px;
        border-radius: 15px;
        max-width: 800px;
        margin: 60px auto;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
    }

    .edit-form-container h1 {
        text-align: left;
        color: #2d572c;
        margin-bottom: 25px;
        font-weight: bold;
        text-transform: uppercase;
    }

    label {
        color: #2d572c;
        font-weight: bold;
        text-transform: uppercase;
    }

    .btn-primary {
        background-color: #2d572c;
        border: none;
    }

    .btn-secondary {
        margin-left: 10px;
    }

    .btn i {
        margin-right: 5px;
    }

    textarea.form-control {
        resize: vertical;
    }
</style>

{{-- Cargar Font Awesome --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<div class="edit-form-container">
    <h1>Editar {{ strtoupper($species->nombre) }}</h1>

    <form action="{{ route('admin.especies.update', $species->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="mb-3">
            <label>Nombre Común</label>
            <input type="text" class="form-control" name="nombre" value="{{ old('nombre', $species->nombre) }}" required>
        </div>

        <div class="mb-3">
            <label>Nombre Científico</label>
            <input type="text" class="form-control" name="nombre_cientifico" value="{{ old('nombre_cientifico', $species->nombre_cientifico) }}" required>
        </div>

        <div class="mb-3">
            <label>Descripción</label>
            <textarea class="form-control" name="descripcion" required>{{ old('descripcion', $species->descripcion) }}</textarea>
        </div>

        <div class="mb-3">
            <label>Hábitat</label>
            <input type="text" class="form-control" name="habitat" value="{{ old('habitat', $species->habitat) }}" required>
        </div>

        <div class="mb-3">
            <label>Ubicación</label>
            <input type="text" class="form-control" name="location" value="{{ old('location', $species->location) }}" required>
        </div>

        <div class="mb-3">
            <label for="category_id">Categoría</label>
            <select class="form-control" id="category_id" name="category_id" required>
                <option value="" disabled>Seleccione una categoría</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" @if($category->id == $species->category_id) selected @endif>
                        {{ $category->nombre }} ({{ $category->tipo }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Imagen Actual</label><br>
            <img src="{{ asset('storage/' . $species->image_path) }}" width="150" class="mb-2 d-block">
            <input type="file" class="form-control" name="image">
        </div>

        <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Actualizar
            </button>
            <a href="{{ route('admin.especies.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Regresar
            </a>
        </div>
    </form>
</div>
@endsection
