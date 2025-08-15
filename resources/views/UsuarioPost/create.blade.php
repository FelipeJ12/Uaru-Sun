@php
$title = 'Crear Publicación';
@endphp

@extends('layouts.app')

@section('content')
<style>
body {
    background: url('{{ asset('images/fonds.jpg') }}') no-repeat center center fixed;
    background-size: cover;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.form-container {
    max-width: 750px;
    background: rgba(30, 28, 28, 0.85);
    padding: 35px 40px;
    border-radius: 15px;
    box-shadow: 0 8px 24px rgba(0,0,0,0.4);
    margin: 40px auto;
    color: white;
}

h2 {
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
textarea,
select,
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

input:focus, textarea:focus, select:focus, input[type="file"]:focus {
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

.d-flex.justify-content-between.mt-4 {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 15px;
    margin-top: 20px;
}

.d-flex.justify-content-between.mt-4 a,
.d-flex.justify-content-between.mt-4 button { flex: 1 1 45%; text-align: center; }

.text-danger {
    font-size: 0.9rem;
    color: #f44336;
    margin-top: 5px;
    display: none;
}

.is-invalid { border-color: #f44336 !important; box-shadow: 0 0 8px #f44336 !important; }

.preview-img {
    max-width: 250px;
    height: auto;
    margin-top: 15px;
    border-radius: 15px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.5);
    display: none;
    object-fit: cover;
}

@media (max-width: 576px) {
    .d-flex.justify-content-between.mt-4 a,
    .d-flex.justify-content-between.mt-4 button { flex: 1 1 100%; }
}
</style>

<div class="form-container">
    <h2>Crear Nueva Publicación</h2>

    <form id="formPublicacion" action="{{ route('UsuarioPost.store') }}" method="POST" enctype="multipart/form-data" novalidate>
        @csrf

        <div class="mb-4">
            <label for="nombre">Nombre Común</label>
            <input type="text" id="nombre" name="nombre" required>
            <div class="text-danger" id="error-nombre">Este campo es obligatorio.</div>
        </div>

        <div class="mb-4">
            <label for="nombre_cientifico">Nombre Científico</label>
            <input type="text" id="nombre_cientifico" name="nombre_cientifico" required>
            <div class="text-danger" id="error-nombre_cientifico">Este campo es obligatorio.</div>
        </div>

        <div class="mb-4">
            <label for="descripcion">Descripción</label>
            <textarea id="descripcion" name="descripcion" rows="3" required></textarea>
            <div class="text-danger" id="error-descripcion">Este campo es obligatorio.</div>
        </div>

        <div class="mb-4">
            <label for="habitat">Hábitat</label>
            <textarea id="habitat" name="habitat" rows="2" required></textarea>
            <div class="text-danger" id="error-habitat">Este campo es obligatorio.</div>
        </div>

        <div class="mb-4">
            <label for="location">Ubicación</label>
            <input type="text" id="location" name="location" required>
            <div class="text-danger" id="error-location">Este campo es obligatorio.</div>
        </div>

        <div class="mb-4">
            <label for="category_id">Categoría</label>
            <select id="category_id" name="category_id" required>
                <option value="" selected disabled>Seleccione una categoría</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->nombre }} ({{ $category->tipo }})</option>
                @endforeach
            </select>
            <div class="text-danger" id="error-category">Debe seleccionar una categoría.</div>
        </div>

        <div class="mb-4">
            <label for="image">Imagen</label>
            <input type="file" id="image" name="image" accept="image/*" required>
            <div class="text-danger" id="error-image">Debe seleccionar una imagen.</div>
            <img id="preview" class="preview-img" alt="Vista previa">
        </div>

        <div class="d-flex justify-content-between mt-4">
            <a href="{{ route('UsuarioPost.index') }}" class="btn-secondary-custom">Cancelar</a>
            <button type="submit" class="btn-custom">Guardar Publicación</button>
        </div>
    </form>
</div>

<script>
document.getElementById('formPublicacion').addEventListener('submit', function(event) {
    let isValid = true;

    const fields = [
        { id: 'nombre', errorId: 'error-nombre' },
        { id: 'nombre_cientifico', errorId: 'error-nombre_cientifico' },
        { id: 'descripcion', errorId: 'error-descripcion' },
        { id: 'habitat', errorId: 'error-habitat' },
        { id: 'location', errorId: 'error-location' },
        { id: 'category_id', errorId: 'error-category' },
        { id: 'image', errorId: 'error-image' }
    ];

    fields.forEach(({ id, errorId }) => {
        const field = document.getElementById(id);
        const error = document.getElementById(errorId);

        if (!field.value || (field.type === 'file' && field.files.length === 0)) {
            error.style.display = 'block';
            field.classList.add('is-invalid');
            isValid = false;
        } else {
            error.style.display = 'none';
            field.classList.remove('is-invalid');
        }
    });

    if (!isValid) event.preventDefault();
});

document.getElementById('image').addEventListener('change', function(event) {
    const input = event.target;
    const preview = document.getElementById('preview');

    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
        }
        reader.readAsDataURL(input.files[0]);
    } else {
        preview.style.display = 'none';
        preview.src = '';
    }
});
</script>
@endsection
