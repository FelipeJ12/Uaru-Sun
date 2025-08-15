
@php
$items = [
        ['label' => 'Inicio', 'url' => route('home')],
        ['label' => 'Enfermedades de Plantas'] // Última miga
    ];
    
    $title = 'Enfermedades en Plantas'; 
@endphp


@extends('layouts.app')

@section('title', 'Enfermedades de Plantas')

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
        box-shadow: 0 0 15px rgba(255, 255, 255, 0.2);
        color: white;
    }
    .custom-table {
        width: 100%;
        background: rgba(30,28,28,0.67);
        color: white;
        font-size: 16px;
        border-collapse: collapse;
        table-layout: fixed;
    }
    .custom-table thead {
        background-color: rgba(30,28,28,0.87);
        font-weight: bold;
    }
    .custom-table th, .custom-table td {
        padding: 12px;
        text-align: left;
        vertical-align: top;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .col-imagen { width: 150px; text-align: center; }
    .col-planta { width: 120px; }
    .col-enfermedad { width: 140px; }
    .col-sintomas { width: 180px; }
    .col-causas { width: 180px; }
    .col-solucion { width: 180px; }
    .col-acciones { width: 140px; text-align: center; }

    .custom-table img {
        width: 250px;
        height: 120px;
        object-fit: cover;
        border-radius: 10px;
    }

    .btn-delete {
        background: linear-gradient(135deg, #ef4444, #b91c1c);
        color: white;
        border: none;
        border-radius: 9999px;
        padding: 8px 16px;
        font-weight: 600;
        cursor: pointer;
        transition: background-color 0.3s ease, transform 0.2s ease;
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        display: flex;
        align-items: center;
        gap: 6px;
    }
    .btn-delete:hover {
        background: linear-gradient(135deg, #b91c1c, #7f1d1d);
        transform: scale(1.05);
    }
    .btn-delete:active {
        transform: scale(0.95);
        box-shadow: none;
    }

    .btn-edit {
        background: linear-gradient(135deg, #3b82f6, #2563eb);
        color: white;
        border: none;
        border-radius: 9999px;
        padding: 8px 16px;
        font-weight: 600;
        cursor: pointer;
        transition: background-color 0.3s ease, transform 0.2s ease;
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    .btn-edit:hover {
        background: linear-gradient(135deg, #2563eb, #1d4ed8);
        transform: scale(1.05);
    }
    .btn-edit:active {
        transform: scale(0.95);
        box-shadow: none;
    }

    .table-responsive {
        overflow-x: auto;
    }

    @media (max-width: 768px) {
        .custom-table {
            font-size: 14px;
        }
        .custom-table th, .custom-table td {
            padding: 10px;
        }
    }
</style>

<!-- SweetAlert para confirmación -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="container mt-4">
    <div class="content-box">
        <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
            <h2 class="text-white mb-2">Enfermedades en Plantas</h2>
            <a href="{{ route('enfermedades.create') }}" class="btn btn-success mb-2">
                <i class="fas fa-plus"></i> Registrar nueva
            </a>
        </div>

        <div class="table-responsive">
            <table class="custom-table">
                <thead>
                    <tr>
                        <th class="col-imagen">Imagen</th>
                        <th class="col-planta">Planta</th>
                        <th class="col-enfermedad">Enfermedad</th>
                        <th class="col-sintomas">Síntomas</th>
                        <th class="col-causas">Causas</th>
                        <th class="col-solucion">Solución</th>
                        <th class="col-acciones">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($enfermedades as $enfermedad)
                        <tr>
                            <td class="text-center">
                                @if ($enfermedad->imagen)
                                    <img src="{{ asset('storage/' . $enfermedad->imagen) }}" alt="imagen">
                                @else
                                    <span class="text-muted">Sin imagen</span>
                                @endif
                            </td>
                            <td>{{ $enfermedad->nombre_planta }}</td>
                            <td>
        <a href="{{ route('enfermedades.show', $enfermedad->id) }}" class="text-white" title="Ver detalles">
            {{ $enfermedad->nombre_enfermedad }}
        </a>
    </td>
                            <td title="{{ $enfermedad->sintomas }}">{{ Str::limit($enfermedad->sintomas, 100) }}</td>
                            <td title="{{ $enfermedad->causas }}">{{ $enfermedad->causas ? Str::limit($enfermedad->causas, 100) : 'No especificadas' }}</td>
                            <td title="{{ $enfermedad->solucion }}">{{ Str::limit($enfermedad->solucion, 100) }}</td>
                            <td class="text-center">
                                <div style="display: flex; justify-content: center; gap: 8px;">
                                    <a href="{{ route('enfermedades.edit', $enfermedad->id) }}" class="btn-edit" title="Editar enfermedad">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <form method="POST" action="{{ route('enfermedades.destroy', $enfermedad->id) }}" class="form-eliminar" style="margin: 0;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-delete" title="Eliminar enfermedad">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">No hay enfermedades registradas aún.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    // Confirmación con SweetAlert para eliminar
    document.querySelectorAll('.form-eliminar').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            Swal.fire({
                title: '¿Estás seguro?',
                text: "Esta acción eliminará la enfermedad y no se puede deshacer.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            });
        });
    });
</script>
@endsection
