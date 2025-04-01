@extends('layouts.app')

@section('title', 'Administrar Peligrosos')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 style="color: white; text-align: center;">Animales peligrosos</h1>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-striped">
            <thead>
            <tr>
                <th>Imagen</th>
                <th>Nombre</th>
                <th>Caracteristicas</th>
                <th>Clasificación</th>
            </tr>
            </thead>
            <tbody>
            @forelse($peligrosos as $peligroso)
                <tr>
                    <td><img src="{{ asset($peligroso->imagen) }}" width="100"></td>
                    <td>{{$peligroso->nombre}}</td>
                    <td>{{$peligroso->caracteristicas}}</td>
                    <td>{{$peligroso->tipo}}</td>

                </tr>
            @empty
                 <tr>
                     <td colspan="4" style="text-align: center">No hay animales peligrosos registrados.</td>
                 </tr>
            @endforelse
            </tbody>
        </table>

        {{ $peligrosos->links() }}
    </div>
@endsection
