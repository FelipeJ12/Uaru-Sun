@extends('layouts.app')

@section('title', 'Administrar Medicinas Naturales')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4 mt-5">
            <h1 class="text-white mb-0">Catálogo de Plantas Medicinales</h1>
            <a href="{{ route('medicinas.create') }}" class="btn btn-success">Agregar planta</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="row">
            @forelse($medicinas as $medicina)
                <div class="col-12 col-md-6 col-lg-4 mb-4">
                    <div class="card h-100 shadow bg-dark text-white border-0">
                        <a href="{{ route('medicinas.show', $medicina->id) }}">
                            <img src="{{ asset('storage/' . $medicina->imagen) }}" class="card-img-top img-fluid" style="height: 250px; object-fit: cover; width: 100%;">
                        </a>
                        <div class="card-body">
                            <h5 class="card-title">{{ $medicina->nombre_comun }}</h5>
                            <p class="card-text">{{ $medicina->usos_medicinales }}</p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info">No hay plantas medicinales disponibles en este momento.</div>
                </div>
            @endforelse
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $medicinas->links() }}
        </div>
    </div>
@endsection
