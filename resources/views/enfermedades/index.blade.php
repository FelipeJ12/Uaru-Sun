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
    .col-planta { width: 140px; }
    .col-enfermedad { width: 160px; }
    .col-sintomas { width: 220px; }
    .col-causas { width: 220px; }
    .col-solucion { width: 220px; }

    .custom-table img {
        width: 250px;
        height: 120px;
        object-fit: cover;
        border-radius: 10px;
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
                            <td>{{ $enfermedad->nombre_enfermedad }}</td>
                            <td title="{{ $enfermedad->sintomas }}">{{ Str::limit($enfermedad->sintomas, 100) }}</td>
                            <td title="{{ $enfermedad->causas }}">{{ $enfermedad->causas ? Str::limit($enfermedad->causas, 100) : 'No especificadas' }}</td>
                            <td title="{{ $enfermedad->solucion }}">{{ Str::limit($enfermedad->solucion, 100) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No hay enfermedades registradas aún.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
