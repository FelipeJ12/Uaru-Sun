@php
$items = [
    ['label' => 'Inicio', 'url' => route('home')],
    ['label' => 'Recomendaciones'] // Última miga
];
$title = '💡Recomendaciones de Mejora'; 
@endphp

@extends('layouts.app')

@section('title', 'Recomendaciones de Mejora')

@section('content')
<div class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
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
                            <h5 class="card-title text-white mb-3">{{ $nuevo->dato }}</h5>
                            <ul class="list-unstyled">
                                <li><strong><i class="fas fa-user me-1"></i> Usuario:</strong> {{ $nuevo->user->email ?? 'No disponible' }}</li>
                                <li><strong><i class="fas fa-thumbtack me-1"></i> Estado:</strong> {{ $nuevo->estado ?? 'No disponible' }}</li>
                            </ul>
                        </div>

                        @if($nuevo->estado == 'Pendiente')
                            <hr>
                            <div class="d-flex flex-column gap-2 mt-2">
                                <a href="{{ route('nuevos.edit', $nuevo->id) }}" class="btn btn-outline-info w-100">
                                    <i class="fas fa-pen me-1"></i> Editar
                                </a>

                                <!-- Botón eliminar con modal -->
                                <button type="button" class="btn btn-outline-danger w-100" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal-{{ $nuevo->id }}">
                                    <i class="fas fa-trash me-1"></i> Eliminar
                                </button>

                                <div class="modal fade text-black" id="confirmDeleteModal-{{ $nuevo->id }}" tabindex="-1" aria-labelledby="confirmDeleteModalLabel-{{ $nuevo->id }}" aria-hidden="true">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="confirmDeleteModalLabel-{{ $nuevo->id }}">Confirmar eliminación</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                      </div>
                                      <div class="modal-body">
                                        ¿Estás seguro de que deseas eliminar esta sugerencia?
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                        <form action="{{ route('nuevos.destroy', $nuevo->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Eliminar</button>
                                        </form>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                            </div>
                            <hr>
                        @endif

                        <div class="text-end mt-auto">
                            <small class="text-white"><i class="fas fa-calendar-alt me-1"></i>Enviado el {{ date('d-m-Y', strtotime($nuevo->fecha)) }}</small>
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
