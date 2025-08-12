@extends('layouts.app')

@section('title', 'Administrar Especies')

@section('content')
<style>
    body {
        background: url('{{ asset('images/fonds.jpg') }}') no-repeat center center fixed;
        background-size: cover;
    }
    .content-box {
        background-color: rgba(30,28,28,0.67);
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 15px rgba(7, 180, 30, 0.2);
        color: white;
    }
    .custom-table {
        width: 100%;
        background: rgba(30,28,28,0.67);
        color: white;
        font-size: 18px;
        border-collapse: collapse;
    }
    .custom-table thead {
        background-color: rgba(30,28,28,0.87);
        font-weight: bold;
    }
    .custom-table th, .custom-table td {
        padding: 15px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
    .custom-table td img {
        max-width: 100%;
        height: auto;
    }
    .table-responsive {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }
    .action-buttons {
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    .action-buttons a, .action-buttons button {
        margin: 5px 0;
        font-size: 18px;
        width: 40px;
        height: 40px;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 0;
        border-radius: 8px;
    }
    .action-buttons a:hover, .action-buttons button:hover {
        opacity: 0.8;
        transform: scale(1.05);
        transition: all 0.2s ease;
    }
    .action-cell {
        text-align: center;
        vertical-align: top;
    }
    /* NUEVA CLASE PARA HABITAT */
    .habitat-col {
        max-width: 250px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
</style>

<div class="container mt-4">
    <div class="content-box">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Administrar Especies</h1>
            @if(auth()->user()?->role === 'admin')
                <a href="{{ route('admin.especies.create') }}" class="btn btn-success">
                    <i class="fas fa-plus"></i> Nueva Especie
                </a>
            @endif
        </div>

        @if(auth()->user()?->role === 'admin')
        <form method="GET" action="{{ route('admin.especies.index') }}">
                <div class="col-2">
                    <select class="form-select" name="filtro">
                        <option value="nombre_comun" {{ request('filtro') == 'nombre_comun' ? 'selected' : '' }}>Nombre Común</option>
                        <option value="habitat" {{ request('filtro') == 'habitat' ? 'selected' : '' }}>Hábitat</option>
                    </select>
                </div>
                <div class="input-group" style="max-width: 900px;">
    <span class="input-group-text bg-primary text-white border-0 rounded-start-pill">
        <i class="fas fa-search"></i>
    </span>
    <input 
        type="text" 
        class="form-control border-0 rounded-end-pill shadow-sm" 
        name="query" 
        value="{{ request('query') }}" 
        placeholder="Buscar especie"
        style="font-size: 0.9rem;">
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
                            <img src="{{ asset('storage/' . $specie->image_path) }}" class="rounded" style="width: 120px; height: 120px; object-fit: cover;">
                        </td>
                        <td>{{ $specie->nombre }}</td>
                        <td class="habitat-col" title="{{ $specie->habitat }}">{{ $specie->habitat }}</td>
                        <td class="action-cell">
                            <div class="action-buttons">
                                @if(auth()->user()?->role === 'admin')
                                    <a href="{{ route('admin.especies.edit', $specie->id) }}" class="btn btn-success" title="Editar">
                                        <img src="{{ asset('images/edit.png') }}" alt="Editar" style="width: 20px; height: 20px;">
                                    </a>
                                    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="{{ $specie->id }}" title="Eliminar">
                                        <img src="{{ asset('images/elim.png') }}" alt="Eliminar" style="width: 20px; height: 20px;">
                                    </button>
                                @endif
                                <a href="{{ route('comentarios.create', $specie->id) }}" class="btn btn-primary" title="Comentarios">
                                    <img src="{{ asset('images/comen.png') }}" alt="Comentarios" style="width: 20px; height: 20px;">
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
                ¿Estás seguro de que deseas eliminar esta especie?
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
            var form = document.getElementById("deleteForm");
            form.action = "/admin/especies/" + id;
        });
    });
</script>
@endsection
