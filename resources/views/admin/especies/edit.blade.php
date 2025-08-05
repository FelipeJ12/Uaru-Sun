@extends('layouts.app')

@section('title', 'Editar Especie')

@section('content')
<div class="container mt-5 text-white">
    <h1>Editar {{ $species->nombre }}</h1>

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

        <!-- Nombre común -->
        <div class="mb-3 text-white"> 
            <label>Nombre Común</label>
            <input type="text" class="form-control" name="nombre" value="{{ old('nombre', $species->nombre) }}" required>
        </div>

        <!-- Nombre Científico -->
        <div class="mb-3 text-white">
            <label>Nombre Científico</label>
            <input type="text" class="form-control" name="nombre_cientifico" value="{{ old('nombre_cientifico', $species->nombre_cientifico) }}" required>
        </div>

        <!-- Descripción -->
        <div class="mb-3 text-white">
            <label>Descripción</label>
            <textarea class="form-control" name="descripcion" required>{{ old('descripcion', $species->descripcion) }}</textarea>
        </div>

        <!-- Hábitat -->
        <div class="mb-3 text-white">
            <label>Hábitat</label>
            <input type="text" class="form-control" name="habitat" value="{{ old('habitat', $species->habitat) }}" required>
        </div>

        <!-- Ubicación -->
        <div class="mb-3 text-white">
            <label>Ubicación</label>
            <input type="text" class="form-control" name="location" value="{{ old('location', $species->location) }}" required>
        </div>

        <!-- Categoría -->
        <div class="mb-3 text-white">
            <label for="category_id" class="form-label">Categoría</label>
            <select class="form-control" id="category_id" name="category_id" required>
                <option value="" disabled>Seleccione una categoría</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" 
                            @if($category->id == $species->category_id) selected @endif>
                        {{ $category->nombre }} ({{ $category->tipo }})
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Imagen -->
        <div class="mb-3 text-white">
            <label>Imagen Actual</label>
            <img src="{{ asset('storage/' . $species->image_path) }}" width="150" class="d-block mb-2">
            <input type="file" class="form-control" name="image">
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>

    
    <!-- Botón de regresar -->
    <a href="{{ route('admin.especies.index') }}" class="btn btn-secondary">Regresar</a>
</div>


    </form> 
</div>
@endsection
