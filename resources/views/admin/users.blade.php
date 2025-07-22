@extends('layouts.app')

@section('content')
<style>
    body {
        background: url('{{ asset('images/fonds.jpg') }}') no-repeat center center fixed;
        background-size: cover;
        font-family: 'Segoe UI', sans-serif;
    }

    .overlay-container {
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }

    .header-box {
        background: linear-gradient(to right, rgb(8, 57, 10), #81c784);
        padding: 20px;
        border-radius: 12px;
        margin-bottom: 30px;
        color: white;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        text-align: center;
    }

    .header-box h2 {
        margin: 0;
        font-size: 28px;
        font-weight: bold;
    }

    .btn-back {
        background-color: #388e3c;
        color: white;
        border-radius: 25px;
        padding: 10px 20px;
        text-decoration: none;
        transition: background-color 0.3s ease;
        font-weight: bold;
    }

    .btn-back:hover {
        background-color: rgb(5, 57, 8);
        color: white;
    }

    .table-custom {
    background-color: rgba(255, 255, 255, 0.3) !important; /* ← este cambio */
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    backdrop-filter: blur(4px); /* ← mejora visual */
}

.table td {
        background-color: rgba(122, 164, 124, 0.8); /* verde claro semitransparente */

    color: #fff; /* texto blanco para destacar */
}

.table th {
    background-color: rgba(44, 183, 51, 0.8); /* verde claro semitransparente */
    color: #003300;
}


</style>

<div class="container mt-5">
    <div class="overlay-container">
        <div class="header-box">
            <h2><i class="fas fa-leaf icon-leaf"></i>Lista de Usuarios Suscritos</h2>
        </div>

        <!-- Botón de regresar -->
        <a href="{{ url()->previous() }}" class="btn-back mb-3 d-inline-block">
            <i class="fas fa-arrow-left me-1"></i> Regresar
        </a>

        <div class="table-responsive table-custom">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Fecha de suscripción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->created_at->format('d/m/Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
