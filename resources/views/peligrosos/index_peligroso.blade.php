@php

$items = [
        ['label' => 'Inicio', 'url' => route('home')],
        ['label' => 'Fauna', 'url' => route('fauna.index')],
        ['label' => 'Animales Peligrosos'] // Última miga
    ];
    $title = 'Animales peligrosos'; 
@endphp


@extends('layouts.app')

@section('title', 'Administrar Peligrosos')

@section('content')
    <style>
        .text-center {
            margin-top: 50px;
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
        }

        .custom-table td img {
            max-width: 100px;
            height: auto;
            border-radius: 8px;
            transition: 0.3s;
        }

        .custom-table td img:hover {
            transform: scale(1.05);
            cursor: pointer;
        }

        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .custom-table .pagination {
            margin-top: 20px;
            text-align: center;
        }

        .no-records td {
            text-align: center;
            font-style: italic;
        }

    </style>

    <div class="container">
        
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
  <a href="{{ route('fauna.index') }}" class="btn btn-success me-md-2">Regresar</a>
</div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="table-responsive">
            <table class="custom-table">
                <thead>
                <tr>
                    <th>Imagen</th>
                    <th>Nombre común</th>
                    <th>Nombre científico</th>
                    <th>Hábitat</th>
                </tr>
                </thead>
                <tbody>
                @forelse($peligrosos as $peligroso)
                    <tr>
                        <td>
                            <a href="{{ route('peligrosos.show', $peligroso->id) }}">
                                <img src="{{ asset('storage/' . $peligroso->imagen) }}" alt="{{ $peligroso->nombre }}">
                            </a>
                        </td>
                        <td>{{ $peligroso->nombre }}</td>
                        <td><em>{{ $peligroso->nombre_cientifico }}</em></td>
                        <td>{{ $peligroso->habitat }}</td>
                    </tr>
                @empty
                    <tr class="no-records">
                        <td colspan="4">No hay animales peligrosos registrados.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        {{ $peligrosos->links() }}
    </div>
@endsection
