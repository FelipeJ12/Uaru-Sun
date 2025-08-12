@extends('layouts.app')

@section('title', 'Administrar Especies')

@section('content')
{{-- Cargar Font Awesome --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
    body {
        background: url('{{ asset('images/fonds.jpg') }}') no-repeat center center fixed;
        background-size: cover;
    }

    .content-box {
        background-color: rgba(255, 255, 255, 0.07);
        padding: 25px;
        border-radius: 15px;
        backdrop-filter: blur(8px);
        color: #fff;
        box-shadow: 0 0 20px rgba(255, 255, 255, 0.2);
    }

    .content-box h1 {
        font-weight: bold;
        text-transform: uppercase;
        color: #ffffff;
    }

    .btn-success, .btn-primary, .btn-danger, .btn-secondary {
        border-radius: 8px;
        font-weight: bold;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .btn i {
        font-size: 16px;
    }

    .btn-success {
        background-color: #198754;
        border: none;
    }

    .btn-danger {
        background-color: #dc3545;
        border: none;
    }

    .btn-primary {
        background-color: #0d6efd;
        border: none;
    }

    .custom-table {
        width: 100%;
        color: #fff;
        font-size: 16px;
        background-color: rgba(0, 0, 0, 0.3);
        border-collapse: collapse;
        border-radius: 10px;
        overflow: hidden;
    }

    .custom-table thead {
        background-color: rgba(0, 0, 0, 0.5);
    }

    .custom-table th, .custom-table td {
        padding: 12px 15px;
        vertical-align: middle;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        text-align: center;
    }

    .custom-table td img {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 10px;
    }

    .action-buttons {
        display: flex;
        flex-direction: row;
        justify-content: center;
        gap: 8px;
    }

    .habitat-col {
        max-width: 250px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    @media (max-width: 768px) {
        .custom-table th, .custom-table td {
            font-size: 13px;
            padding: 10px;
        }

        .custom-table td img {
            width: 80px;
            height: 80px;
        }

        .action-buttons .btn {
            width: 35px;
            height: 35px;
        }
    }
</style>

<div class="container mt-4">
    <div class="content-box">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4">
            <h1>Administrar Especies</h1>
            @if(auth()->user()?->role === 'admin')
                <a href="{{ route('admin.especies.create') }}" class="btn btn-success mt-2 mt-md-0">
                    <i class="fas fa-plus"></i> Nueva Especie
                </a>
            @endif
        </div>

        @if(auth()->user()?->role === 'admin')
        <form method="GET" action="{{ route('admin.especies.index') }}">
            <div class="row mb-3">
                <div class="col-md-2 col-12 mb-2">
                    <select class="form-select" name="filtro">
                        <option value="nombre_comun" {{ request('filtro') == 'nombre_comun' ? 'selected' : '' }}>Nombre Común</option>
                        <option value="habitat" {{ request('filtro') == 'habitat' ? 'selected' : '' }}>Hábitat</option>
                    </select>
                </div>
                <div class="col-md-9 col-12 mb-2">
                    <input type="text" class="form-control" name="query" value="{{ request('query') }}" placeholder="Buscar especie">
                </div>
                <div class="col-md-1 col-12 mb-2">
                    <button type="submit" class="btn btn-primary w-100"><i class="fas fa-search"></i></button>
                </div>
            </div>
        </form>
        @endif

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="table-responsive">
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>Imagen</th>
                        <th>Nombre</th>
                        <th>Hábitat</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($species as $specie)
                    <tr>
                        <td>
                            <img src="{{ asset('storage/' . $specie->image_path) }}" alt="Imagen">
                        </td>
                        <td>{{ $specie->nombre }}</td>
                        <td class="habitat-col" title="{{ $specie->habitat }}">{{ $specie->habitat }}</td>
                        <td>
                            <div class="action-buttons">
                                @if(auth()->user()?->role === 'admin')
                                    <a href="{{ route('admin.especies.edit', $specie->id) }}" class="btn btn-success" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" 
                                        data-id="{{ $specie->id }}" data-nombre="{{ $specie->nombre }}" title="Eliminar">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                @endif
                                <a href="{{ route('comentarios.create', $specie->id) }}" class="btn btn-primary" title="Comentarios">
                                    <i class="fas fa-comments"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">No hay especies.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{ $species->appends(request()->query())->links() }}
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content text-dark">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirmar Eliminación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                ¿Estás seguro de que deseas eliminar la publicacion <strong><span id="specieName"></span></strong>?
            </div>
            <div class="modal-footer">
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var deleteModal = document.getElementById("deleteModal");
        deleteModal.addEventListener("show.bs.modal", function(event) {
            var button = event.relatedTarget;
            var id = button.getAttribute("data-id");
            var nombre = button.getAttribute("data-nombre");
            var form = document.getElementById("deleteForm");
            form.action = "/admin/especies/" + id;

            var specieNameSpan = deleteModal.querySelector("#specieName");
            specieNameSpan.textContent = nombre;
        });
    });
</script>
@endsection
