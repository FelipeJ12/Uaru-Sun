@extends('layouts.app')

@section('title', 'Eventos Programados')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4 mt-5">
            <h1 class="text-white mb-0">🌿 Eventos Programados</h1>
            <a href="{{ route('eventos.create') }}" class="btn btn-success">Agregar evento</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success shadow-sm">{{ session('success') }}</div>
        @endif

        @if(session('danger'))
            <div class="alert alert-danger shadow-sm">{{ session('danger') }}</div>
        @endif

        <div class="row">
            @forelse($eventos as $evento)
                <div class="col-12 col-md-6 col-lg-4 mb-4">
                   <div class="card h-100 shadow bg-success bg-opacity-50 text-white position-relative rounded-4">
                        <div class="card-body d-flex flex-column justify-content-between">
                            <div>
                                @php $fecha = date('Y-m-d'); @endphp
                                <div class="text-center mb-3 position-relative">
                                    <h5 class="card-title mb-0 d-inline-block position-relative" style="font-weight: 600;">
                                        <i class="bi bi-calendar-event-fill me-2"></i>{{ $evento->descripcion }}
                                    </h5>
                                </div>
                                <div class="text-end">
    @if($evento->fecha_evento == $fecha)
        <span class="badge bg-success text-white px-3 py-2 rounded-pill shadow-sm" style="font-size: 0.85rem;">
            <i class="fas fa-calendar-day me-1"></i> Hoy
        </span>
    @elseif($evento->fecha_evento < $fecha)
        <span class="badge bg-danger text-white px-3 py-2 rounded-pill shadow-sm" style="font-size: 0.85rem;">
            <i class="fas fa-hourglass-end me-1"></i> Pasado
        </span>
    @else
        <span class="badge bg-warning text-dark px-3 py-2 rounded-pill shadow-sm" style="font-size: 0.85rem;">
            <i class="fas fa-clock me-1"></i> Próximo
        </span>
    @endif
</div>

                                <hr>
                               <ul class="list-unstyled">
    <li><strong><i class="fas fa-calendar me-2"></i>Fecha:</strong> {{ \Carbon\Carbon::parse($evento->fecha_evento)->format('d/m/Y') }}</li>
    <li><strong><i class="fas fa-clock me-2"></i>Hora:</strong> {{ \Carbon\Carbon::parse($evento->hora_evento)->format('h:i A') }}</li>
    <li><strong><i class="fas fa-map-marker-alt me-2"></i>Dirección:</strong> {{ $evento->url }}</li>
    <li><strong><i class="fas fa-user me-2"></i>Registrado por:</strong> {{ $evento->user->email ?? 'correo no disponible' }}</li>
</ul>

                            </div>
                            <hr>

                            {{-- Solo los administradores pueden editar o eliminar --}}
                            @if(auth()->check() && auth()->user()->role == 'admin')
                                <div class="d-flex flex-column gap-2 mt-2">
    <a href="{{ route('eventos.edit', $evento->id) }}" class="btn btn-outline-info w-100">
        <i class="fas fa-pen me-2"></i> Editar
    </a>
    <form action="{{ route('eventos.destroy', $evento->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este evento?')">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-outline-danger w-100">
            <i class="fas fa-trash me-2"></i> Eliminar
        </button>
    </form>
</div>

                            @endif

                            <div class="mt-auto text-end">
                                <small class="text-white-50">Creado el {{ $evento->created_at->format('d/m/Y') }}</small>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info shadow-sm text-center">
                        No hay eventos programados aún.
                    </div>
                </div>
            @endforelse
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $eventos->links() }}
        </div>
    </div>
@endsection
