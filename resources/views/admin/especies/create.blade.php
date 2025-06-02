@extends('layouts.app')

@section('title', 'Nueva Especie')

@section('content')
<style>
    body {
        background-image: url('{{ asset('images/fonds.jpg') }}');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
    }

    .form-container {
        background-color: rgba(255, 255, 255, 0.95);
        padding: 40px;
        border-radius: 20px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        max-width: 800px;
        margin: 50px auto;
    }

    .form-label {
        font-weight: 600;
        color: #333;
    }

    .form-control {
        border-radius: 10px;
        border: 1px solid #ccc;
    }

    textarea.form-control {
        resize: none;
    }

    .btn-primary {
        background-color: #28a745;
        border-color: #28a745;
        border-radius: 10px;
        padding: 10px 30px;
        font-weight: bold;
    }

    .btn-secondary {
        border-radius: 10px;
        padding: 10px 30px;
        font-weight: bold;
    }

    h1 {
        color: #2c3e50;
        font-weight: 700;
        text-align: center;
        margin-bottom: 30px;
    }

    .btn-group {
        display: flex;
        justify-content: space-between;
        gap: 15px;
        margin-top: 20px;
    }

    #preview img {
        max-width: 100%;
        max-height: 300px;
        margin-top: 15px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }
</style>

<div class="container">
    <div class="form-container">
        <h1>Agregar Nueva Especie</h1>

        <form id="especieForm" action="{{ route('admin.especies.store') }}" method="POST" enctype="multipart/form-data" novalidate>
            @csrf

            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre Común</label>
                <input type="text" class="form-control" id="nombre" name="nombre" maxlength="35" value="{{ old('nombre') }}" required oninput="validarNombre()">
                <div id="nombreError" class="text-danger" style="display: none;">El nombre debe contener al menos dos letras y no debe tener más de un espacio consecutivo.</div>
            </div>

            <div class="mb-3">
                <label for="nombre_cientifico" class="form-label">Nombre Científico</label>
                <input type="text" class="form-control" id="nombre_cientifico" name="nombre_cientifico" value="{{ old('nombre_cientifico') }}" required oninput="validarNombreCientifico()">
                <div id="nombreCientificoError" class="text-danger" style="display: none;">El nombre científico debe contener al menos dos letras.</div>
            </div>

            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required oninput="validarDescripcion()">{{ old('descripcion') }}</textarea>
                <div id="descripcionError" class="text-danger" style="display: none;">La descripción debe tener al menos 5 caracteres.</div>
            </div>

            <div class="mb-3">
                <label for="habitat" class="form-label">Hábitat</label>
                <textarea class="form-control" id="habitat" name="habitat" rows="2" required oninput="validarHabitat()">{{ old('habitat') }}</textarea>
                <div id="habitatError" class="text-danger" style="display: none;">El hábitat debe tener al menos 5 caracteres.</div>
            </div>

            <div class="mb-3">
                <label for="location" class="form-label">Ubicación</label>
                <input type="text" class="form-control" id="location" name="location" required oninput="validarLocation()" value="{{ old('location') }}">
                <div id="locationError" class="text-danger" style="display: none;">La ubicación debe tener al menos 3 caracteres.</div>
            </div>

            <div class="mb-3">
                <label for="category_id" class="form-label">Categoría</label>
                <select class="form-control" id="category_id" name="category_id" required onchange="validarCategoria()">
                    <option value="" disabled {{ old('category_id') ? '' : 'selected' }}>Seleccione una categoría</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->nombre }} ({{ $category->tipo }})
                        </option>
                    @endforeach
                </select>
                <div id="categoriaError" class="text-danger" style="display: none;">Debe seleccionar una categoría.</div>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Imagen</label>
                <input type="file" class="form-control" id="image" name="image" accept="image/*" onchange="validarImagen()" required>
                <div id="imagenError" class="text-danger" style="display: none;">Debe subir una imagen válida.</div>
                <div id="preview"></div> <!-- Aquí se mostrará la previsualización -->
            </div>

            <div class="btn-group">
                <button type="submit" class="btn btn-primary" id="guardarBtn">
                    <span id="guardarIcono" class="me-2"><i class="fas fa-save"></i></span>
                    Guardar
                </button>
                <a href="{{ route('admin.especies.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>

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
                const btn = document.getElementById('guardarBtn');
                const icono = document.getElementById('guardarIcono');

                btn.disabled = true;
                icono.innerHTML = `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>`;

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

                    btn.disabled = false;
                    icono.innerHTML = `<i class="fas fa-save"></i>`;
                }
            });
        </script>
    </div>
</div>
@endsection
