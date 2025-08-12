@extends('layouts.app')

@section('content')
<style>
    body {
        background: url('{{ asset('images/fonds.jpg') }}') no-repeat center center fixed;
        background-size: cover;
        font-family: 'Segoe UI', sans-serif;
        position: relative;
        min-height: 100vh;
        margin: 0;
    }

    /* Botón Regresar fijo en esquina superior izquierda, fuera del contenedor */
    .btn-back {
        position: fixed;
        top: 90px; /* bajado */
        left: 10px;
        background-color: #388e3c;
        color: white;
        border-radius: 25px;
        padding: 10px 20px;
        text-decoration: none;
        transition: background-color 0.3s ease;
        font-weight: bold;
        z-index: 1050;
        box-shadow: 0 2px 8px rgba(0,0,0,0.3);
    }

    .btn-back:hover {
        background-color: rgb(5, 57, 8);
        color: white;
    }

    .overlay-container {
        padding: 30px;
        border-radius: 15px;
        /* quitar fondo y sombra para transparencia total */
        background-color: transparent !important;
        box-shadow: none !important;
        backdrop-filter: none !important;
        margin-top: 60px; /* para no tapar el botón */
    }

    .header-box {
        background: transparent !important;
        padding: 0 0 20px 0;
        margin-bottom: 30px;
        color: white;
        text-align: left;
        font-weight: bold;
        font-size: 28px;
        display: flex;
        align-items: center;
        gap: 10px;
        box-shadow: none !important;
    }

    .header-box i.icon-leaf {
        font-size: 28px;
        color: white;
    }

    .table-custom {
        background-color: transparent !important;
        border-radius: 10px;
        overflow: visible;
        box-shadow: none !important;
        backdrop-filter: none !important;
        color: white;
    }

    .table td {
        background-color: rgba(122, 164, 124, 0.3);
        color: #fff;
        white-space: nowrap;
    }

    .table th {
        background-color: rgba(44, 183, 51, 0.3);
        color: #e0ffe0;
        white-space: nowrap;
    }

    /* Ajustes responsivos */
    @media (max-width: 576px) {
        .overlay-container {
            padding: 15px;
        }
        .header-box {
            font-size: 22px;
        }
        .btn-back {
            padding: 8px 15px;
            font-size: 14px;
            position: fixed;
            top: 15px;
            left: 15px;
            width: auto;
        }
        .table-responsive {
            overflow-x: auto;
        }
        .table th, .table td {
            font-size: 14px;
            padding: 8px 10px;
            white-space: nowrap;
        }
    }
</style>

<!-- Botón fuera del contenedor, fijo en la esquina -->
<a href="#" 
   onclick="event.preventDefault(); history.back();" 
   style="color: yellow; text-decoration: none; font-weight: bold; position: fixed; top: 100px; left: 10px; background-color: green; padding: 8px 16px; border-radius: 5px; box-shadow: 0 2px 6px rgba(0,0,0,0.3); z-index: 1050;">
   <i class="fas fa-arrow-left me-1"></i> Regresar
</a>


<div class="container mt-5">
    <div class="overlay-container">
        <div class="header-box">
            <i class="fas fa-leaf icon-leaf"></i>
            Lista de Usuarios Suscritos
        </div>

        <div class="table-responsive table-custom">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Fecha de suscripción</th>
                        <th>Acciones</th> {{-- Nueva columna --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->created_at->format('d/m/Y') }}</td>
                            <td>
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" 
                                      onsubmit="return confirm('¿Seguro que deseas eliminar al usuario {{ $user->name }}?');">
                                    @csrf
                                    @method('DELETE')
                                   
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
