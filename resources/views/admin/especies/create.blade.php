@extends('layouts.app')

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

    input[type="text"]:focus,
    textarea:focus,
    select:focus,
    input[type="file"]:focus {
        outline: none;
        border-color: #81c784;
        box-shadow: 0 0 8px #81c784;
    }

    textarea {
        min-height: 100px;
    }

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

    .btn-custom:hover {
        background: linear-gradient(135deg, #15803d, #166534);
        transform: scale(1.05);
    }

    .btn-custom:disabled {
        background: #4caf507a;
        cursor: not-allowed;
        transform: none;
        box-shadow: none;
    }

    .btn-secondary-custom {
        background: #4a4a4a;
        color: #ccc;
        border: none;
        padding: 12px 25px;
        font-size: 1.1rem;
        font-weight: 600;
        border-radius: 9999px;
        cursor: pointer;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        transition: background 0.3s ease, color 0.3s ease;
        margin-top: 10px;
        text-align: center;
        display: inline-block;
        text-decoration: none;
        line-height: 1;
    }

    .btn-secondary-custom:hover {
        background: #6b6b6b;
        color: white;
    }

    .btn-group {
        display: flex;
        justify-content: space-between;
        gap: 15px;
        margin-top: 20px;
        flex-wrap: wrap;
    }

    .btn-group > * {
        flex: 1 1 45%;
        text-align: center;
    }

    @media (max-width: 576px) {
        .btn-group > * {
            flex: 1 1 100%;
        }
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
    <h1>Agregar Nueva Especie</h1>

    <form id="especieForm" action="{{ route('admin.especies.store') }}" method="POST" enctype="multipart/form-data" novalidate>
        @csrf

        <div class="mb-3">
            <label for="nombre">Nombre Común</label>
            <input type="text" id="nombre" name="nombre" maxlength="35" value="{{ old('nombre') }}" required oninput="validarNombre()">
            <div id="nombreError" class="text-danger">El nombre debe contener al menos dos letras y no debe tener más de un espacio consecutivo.</div>
        </div>

        <div class="mb-3">
            <label for="nombre_cientifico">Nombre Científico</label>
            <input type="text" id="nombre_cientifico" name="nombre_cientifico" value="{{ old('nombre_cientifico') }}" required oninput="validarNombreCientifico()">
            <div id="nombreCientificoError" class="text-danger">El nombre científico debe contener al menos dos letras.</div>
        </div>

        <div class="mb-3">
            <label for="descripcion">Descripción</label>
            <textarea id="descripcion" name="descripcion" rows="3" required oninput="validarDescripcion()">{{ old('descripcion') }}</textarea>
            <div id="descripcionError" class="text-danger">La descripción debe tener al menos 5 caracteres.</div>
        </div>

        <div class="mb-3">
            <label for="habitat">Hábitat</label>
            <textarea id="habitat" name="habitat" rows="2" required oninput="validarHabitat()">{{ old('habitat') }}</textarea>
            <div id="habitatError" class="text-danger">El hábitat debe tener al menos 5 caracteres.</div>
        </div>

        <div class="mb-3">
            <label for="location">Ubicación</label>
            <input type="text" id="location" name="location" value="{{ old('location') }}" required oninput="validarLocation()">
            <div id="locationError" class="text-danger">La ubicación debe tener al menos 3 caracteres.</div>
        </div>

        <div class="mb-3">
            <label for="category_id">Categoría</label>
            <select id="category_id" name="category_id" required onchange="validarCategoria()">
                <option value="" disabled {{ old('category_id') ? '' : 'selected' }}>Seleccione una categoría</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->nombre }} ({{ $category->tipo }})
                    </option>
                @endforeach
            </select>
            <div id="categoriaError" class="text-danger">Debe seleccionar una categoría.</div>
        </div>

        <div class="mb-3">
            <label for="image">Imagen</label>
            <input type="file" id="image" name="image" accept="image/*" required onchange="validarImagen()">
            <div id="imagenError" class="text-danger">Debe subir una imagen válida.</div>
            <div id="preview"></div>
        </div>

        <div class="btn-group">
            <a href="{{ route('admin.especies.index') }}" class="btn-secondary-custom">Cancelar</a>
            <button type="submit" class="btn-custom" id="guardarBtn">
                <span id="guardarIcono" class="me-2"><i class="fas fa-save"></i></span>
                Guardar
            </button>
        </div>
    </form>
</div>

<script>
    function validarNombre() {
        const input = document.getElementById('nombre');
        const error = document.getElementById('nombreError');
        let valor = input.value;

        valor = valor.replace(/[^a-zA-ZÁÉÍÓÚáéíóúñÑ\s]/g, '').replace(/\s{2,}/g, ' ').replace(/^\s+/, '').slice(0, 35);
        input.value = valor;

        const valido = valor.replace(/\s+/g, '').length >= 2;
        error.style.display = valido ? 'none' : 'block';
        input.classList.toggle('is-invalid', !valido);
    }

    function validarNombreCientifico() {
        const input = document.getElementById('nombre_cientifico');
        const error = document.getElementById('nombreCientificoError');
        let valor = input.value;

        valor = valor.replace(/[^a-zA-ZÁÉÍÓÚáéíóúñÑ\s]/g, '').replace(/\s{2,}/g, ' ').replace(/^\s+/, '').slice(0, 50);
        input.value = valor;

        const valido = valor.replace(/\s+/g, '').length >= 2;
        error.style.display = valido ? 'none' : 'block';
        input.classList.toggle('is-invalid', !valido);
    }

    function validarDescripcion() {
        const input = document.getElementById('descripcion');
        const error = document.getElementById('descripcionError');
        const valor = input.value.trim();

        const valido = valor.length >= 5;
        error.style.display = valido ? 'none' : 'block';
        input.classList.toggle('is-invalid', !valido);
    }

    function validarHabitat() {
        const input = document.getElementById('habitat');
        const error = document.getElementById('habitatError');
        const valor = input.value.trim();

        const valido = valor.length >= 5;
        error.style.display = valido ? 'none' : 'block';
        input.classList.toggle('is-invalid', !valido);
    }

    function validarLocation() {
        const input = document.getElementById('location');
        const error = document.getElementById('locationError');
        const valor = input.value.trim();

        const valido = valor.length >= 3;
        error.style.display = valido ? 'none' : 'block';
        input.classList.toggle('is-invalid', !valido);
    }

    function validarCategoria() {
        const select = document.getElementById('category_id');
        const error = document.getElementById('categoriaError');

        const valido = !!select.value;
        error.style.display = valido ? 'none' : 'block';
        select.classList.toggle('is-invalid', !valido);
    }

    function validarImagen() {
        const input = document.getElementById('image');
        const error = document.getElementById('imagenError');
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

    window.addEventListener('load', () => {
        if ({{ $errors->any() ? 'true' : 'false' }}) {
            validarNombre();
            validarNombreCientifico();
            validarDescripcion();
            validarHabitat();
            validarLocation();
            validarCategoria();
            validarImagen();
        }
    });

    document.getElementById('especieForm').addEventListener('submit', function (event) {
        validarNombre();
        validarNombreCientifico();
        validarDescripcion();
        validarHabitat();
        validarLocation();
        validarCategoria();
        validarImagen();

        const errores = document.querySelectorAll('.is-invalid');
        if (errores.length > 0) {
            event.preventDefault();
            event.stopPropagation();

            const btn = document.getElementById('guardarBtn');
            const icono = document.getElementById('guardarIcono');

            btn.disabled = false;
            icono.innerHTML = `<i class="fas fa-save"></i>`;
            return;
        }

        const btn = document.getElementById('guardarBtn');
        const icono = document.getElementById('guardarIcono');

        btn.disabled = true;
        icono.innerHTML = `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>`;
    });
</script>
@endsection
