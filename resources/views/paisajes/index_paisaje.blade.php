@extends('layouts.app')

@section('title', 'Administrar Paisajes')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 style="color: white; text-align: center;">Bienvenido a Paisajes Naturales</h1>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="table-responsive">
            <table class="custom-table">
                <thead>
                <tr>
                    <th>Imagen</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                </tr>
                </thead>
                <tbody>
                @foreach($paisajes as $paisaje)
                    <tr>
                        <td>
                            <a href="{{ route('paisajes.show', $paisaje->id) }}">
                                <img src="{{ asset($paisaje->url) }}" width="500">
                            </a>
                        </td>
                        <td>{{$paisaje->nombres}}</td>
                        <td>{{$paisaje->descripcion}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        {{ $paisajes->links() }}
    </div>

    <style>

        .text-center {
            margin-top: 80px; /* Ajusta este valor según sea necesario */
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
            max-width: 100%;
            height: auto;
        }

        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }
        .custom-table .pagination {
            margin-top: 20px;
            text-align: center;
        }
        .text-center {
            margin-top: 50px;
        }
    </style>


@endsection
