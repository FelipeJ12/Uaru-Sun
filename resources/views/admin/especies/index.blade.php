@extends('layouts.app')

@section('title', 'Administrar Especies')

@section('content')
<style>
    body {
        background: url('{{ asset('images/fonds.jpg') }}') no-repeat center center;
        background-size: cover;
        background-attachment: fixed;
    }

    @media (max-width: 767px) {
        body {
            background-attachment: scroll;
        }

        .custom-table th, .custom-table td {
            font-size: 14px;
            padding: 10px;
        }

        .custom-table td img {
            width: 80px;
            height: 80px;
        }

        .action-buttons a, .action-buttons button {
            width: 35px;
            height: 35px;
        }

        .action-buttons img {
            width: 18px !important;
            height: 18px !important;
        }

        .habitat-col {
            max-width: 150px;
        }

        .content-box h1 {
            font-size: 24px;
        }
    }

    .content-box {
        background-color: rgba(30,28,28,0.67);
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 15px rgba(255, 255, 255, 0.2);
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

    /* Botones en fila */
    .action-buttons {
        display: flex;
        flex-direction: row;
        justify-content: center;
        gap: 5px;
    }

    .action-buttons a, .action-buttons button {
        font-size: 18px;
        width: 40px;
        height: 40px;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 0;
        border-radius: 8px;
        margin: 0;
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

    .habitat-col {
        max-width: 250px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
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
                    <button type="submit" class="btn btn-primary w-100">Buscar</button>
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
