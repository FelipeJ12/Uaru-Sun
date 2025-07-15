@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2>Lista de Usuarios Suscritos</h2>

        <!-- Botón de regresar -->
        <a href="{{ url()->previous() }}" class="btn btn-outline-dark mb-3">
            <i class="fas fa-arrow-left me-1"></i> Regresar
        </a>

        <table class="table">
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
                        <td>{{ $user->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection