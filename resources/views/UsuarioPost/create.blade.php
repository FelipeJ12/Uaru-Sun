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
        background-color: rgba(255, 255, 255, 0.85);
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
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
        background-color: #4CAF50;
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

    .text-danger {
        font-size: 0.9rem;
        display: none;
    }

    .preview-img {
    max-width: 200px;   /* Tamaño más pequeño */
    height: auto;
    margin-top: 15px;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.2);
}

</style>

<div class="container mt-4">
    <div class="content-box">
        <h1 class="text-center">Agregar Nueva Especie</h1>

        <form id="formEspecie" action="{{ route('UsuarioPost.store') }}" method="POST" enctype="multipart/form-data" novalidate>
            @csrf

            <!-- Campos del formulario (igual que antes) -->
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre Común</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
                <div class="text-danger" id="error-nombre">Este campo es obligatorio.</div>
            </div>

            <div class="mb-3">
                <label for="nombre_cientifico" class="form-label">Nombre Científico</label>
                <input type="text" class="form-control" id="nombre_cientifico" name="nombre_cientifico" required>
                <div class="text-danger" id="error-nombre_cientifico">Este campo es obligatorio.</div>
            </div>

            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
                <div class="text-danger" id="error-descripcion">Este campo es obligatorio.</div>
            </div>

            <div class="mb-3">
                <label for="habitat" class="form-label">Hábitat</label>
                <textarea class="form-control" id="habitat" name="habitat" rows="2" required></textarea>
                <div class="text-danger" id="error-habitat">Este campo es obligatorio.</div>
            </div>

            <div class="mb-3">
                <label for="location" class="form-label">Ubicación</label>
                <input type="text" class="form-control" id="location" name="location" required>
                <div class="text-danger" id="error-location">Este campo es obligatorio.</div>
            </div>

            <div class="mb-3">
                <label for="category_id" class="form-label">Categoría</label>
                <select class="form-control" id="category_id" name="category_id" required>
                    <option value="" selected disabled>Seleccione una categoría</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->nombre }} ({{ $category->tipo }})</option>
                    @endforeach
                </select>
                <div class="text-danger" id="error-category">Debe seleccionar una categoría.</div>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Imagen</label>
                <input type="file" class="form-control" id="image" name="image" required accept="image/*">
                <div class="text-danger" id="error-image">Debe seleccionar una imagen.</div>
                <!-- Imagen previsualización -->
                <img id="preview" class="preview-img" src="#" alt="Vista previa" style="display: none;">
            </div>

            <button type="submit" class="btn btn-primary">Guardar Publicación</button>
            <a href="{{ route('UsuarioPost.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>

<!-- Scripts -->
<script>
    document.getElementById('formEspecie').addEventListener('submit', function(event) {
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

        if (!isValid) {
            event.preventDefault();
        }
    });

    // Vista previa de imagen
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
        }
    });
</script>

@endsection
