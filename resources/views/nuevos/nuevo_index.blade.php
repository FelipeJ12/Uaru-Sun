@php
    $title = 'Recomendaciones del Sistema'; 
@endphp

@extends('layouts.app')

@section('title', 'Recomendaciones de Mejora')

@section('content')
    <div class="container mt-5">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-white">💡 Recomendaciones del Sistema</h2>
            <a href="{{ route('nuevos.create') }}" class="btn btn-success">
                + Nueva sugerencia
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success shadow-sm">{{ session('success') }}</div>
        @endif

        @if(session('danger'))
            <div class="alert alert-danger shadow-sm">{{ session('danger') }}</div>
        @endif

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            @forelse($nuevos as $nuevo)
                <div class="col">
                    <div class="card h-100 shadow bg-success bg-opacity-50 text-white position-relative rounded-4">
                        <div class="card-body d-flex flex-column justify-content-between">
                            <div>
                                <h5 class="card-title text-white mb-3">
                                    {{ $nuevo->dato }}
                                </h5>
                                <ul class="list-unstyled">
                                    <li>
                                        <strong><i class="fas fa-user me-1"></i> Usuario:</strong>
                                        {{ $nuevo->user->email ?? 'No disponible' }}
                                    </li>
                                    <li>
                                        <strong><i class="fas fa-thumbtack me-1"></i> Estado:</strong>
                                        {{ $nuevo->estado ?? 'No disponible' }}
                                    </li>
                                </ul>
                            </div>

                            @if($nuevo->estado == 'Pendiente')
                                <hr>
                                <div class="d-flex flex-column gap-2 mt-2">
                                    <a href="{{ route('nuevos.edit', $nuevo->id) }}" class="btn btn-outline-info w-100">
                                        <i class="fas fa-pen me-1"></i> Editar
                                    </a>

                                    <form action="{{ route('nuevos.destroy', $nuevo->id) }}" method="POST"
                                          onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta sugerencia?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger w-100">
                                            <i class="fas fa-trash me-1"></i> Eliminar
                                        </button>
                                    </form>
                                </div>
                                <hr>
                            @endif

                            <div class="text-end mt-auto">
                                <small class="text-white">
                                    <i class="fas fa-calendar-alt me-1"></i>Enviado el
                                    {{ date('d-m-Y', strtotime($nuevo->fecha)) }}
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info text-center shadow-sm">
                        Aún no hay sugerencias registradas.
                    </div>
                </div>
            @endforelse
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $nuevos->links() }}
        </div>

    </div>
@endsection