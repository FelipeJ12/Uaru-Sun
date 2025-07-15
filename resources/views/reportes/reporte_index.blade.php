@extends('layouts.app')

@section('title', 'Reportes de Actividades Ilegales')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4 mt-5">
            <h1 class="text-white mb-0">Reportes de actividades ilegales</h1>
        </div>
        <div class="alert alert-warning text-dark">
            Estos reportes corresponden a actividades ilegales identificadas en áreas protegidas de Honduras, como la <strong>caza furtiva</strong> y la <strong>deforestación no autorizada</strong>.
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="row">
            @forelse($reportes as $reporte)
                <div class="col-12 col-md-6 col-lg-4 mb-4">
                    <div class="card h-100 shadow bg-success bg-opacity-50 text-white position-relative rounded-4">
                        @if($reporte->imagen)
                            <img src="{{ asset('storage/' . $reporte->imagen) }}" class="card-img-top img-fluid"
                                 style="height: 230px; object-fit: cover; width: 100%;">
                        @else
                            @if($reporte->actividad == 'Caza')
                                <img src="{{ asset('images/caza_animal.jpg') }}" class="card-img-top img-fluid"
                                     style="height: 230px; object-fit: cover; width: 100%;">
                            @else
                                <img src="{{ asset('images/deforestacion.jpg') }}" class="card-img-top img-fluid"
                                     style="height: 230px; object-fit: cover; width: 100%;">
                            @endif
                        @endif

                        <div class="card-body d-flex flex-column justify-content-between">
                            <div>
                                <h5 class="card-title">
                                    {{ $reporte->actividad === 'Caza' ? 'Caza furtiva' : 'Deforestación' }}
                                </h5>
                                <hr class="bg-light">
                                <p class="card-text"><strong>Dirección:</strong> {{ $reporte->direccion }}</p>
                                <p class="card-text"><strong>Correo:</strong> {{ $reporte->user->email ?? 'correo no disponible' }}</p>
                            </div>

                            <div class="mt-auto text-end">
                                <small class="text-white-50">
                                    {{ \Carbon\Carbon::parse($reporte->fecha)->format('d/m/Y') }}
                                </small>
                            </div>
                        </div>
                    </div>
                </div>

            @empty
                <div class="col-12">
                    <div class="alert alert-info">No hay reportes disponibles en este momento.</div>
                </div>
            @endforelse
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $reportes->links() }}
        </div>
    </div>
@endsection
