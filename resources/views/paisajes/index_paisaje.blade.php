@extends('layouts.app')

@section('title', 'Administrar Paisajes')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4 mt-5">
            <h1 class="text-white mb-0">Bienvenido a Paisajes Naturales</h1>
            <a href="{{ route('paisajes.create') }}" class="btn btn-success">Agregar Paisaje</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="row">
            @foreach($paisajes as $paisaje)
                <div class="col-12 col-md-6 col-lg-4 mb-4">
                    <div class="card h-100 shadow bg-dark text-white border-0">
                        <a href="{{ route('paisajes.show', $paisaje->id) }}">
                            @if($paisaje->id <= 5)
                                <img src="{{ asset($paisaje->url) }}" class="card-img-top img-fluid" style="height: 250px; object-fit: cover; width: 100%;">
                            @else
                                <img src="{{ asset('storage/' . $paisaje->url) }}" class="card-img-top img-fluid" style="height: 250px; object-fit: cover; width: 100%;">
                            @endif
                        </a>
                        <div class="card-body">
                            <h5 class="card-title">{{ $paisaje->nombres }}</h5>
                            <p class="card-text">{{ $paisaje->descripcion }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $paisajes->links() }}
        </div>
    </div>
@endsection