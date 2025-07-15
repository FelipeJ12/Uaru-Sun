@extends('layouts.app')

@section('title', 'Mi Perfil')

@section('content')
<div class="container">
    {{-- IMPORTAR FONT AWESOME PARA ÍCONOS --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        .text-center {
            margin-top: 80px;
        }

        

        .avatar {
            width: 160px;
            height: 160px;
            border-radius: 50%;
            background-color: #4CE4A0;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 auto 25px auto;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
            cursor: pointer;
        }

        .avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
            display: block;
        }

        .custom-dark-card {
            background-color: #000;
            color: white;
            border-radius: 12px;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .custom-dark-card .card-title,
        .custom-dark-card .card-text {
            color: white;
        }

        .custom-dark-card a {
            text-decoration: none;
            color: inherit;
        }

        .custom-dark-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(255, 255, 255, 0.2);
        }

        .custom-badge {
            background-color: #28a745;
            color: white;
            padding: 6px 10px;
            border-radius: 15px;
            display: inline-block;
            font-size: 0.85rem;
            font-weight: bold;
            margin-top: 10px;
        }

        /* MODAL DE IMAGEN */
        .modal {
            display: none;
            position: fixed;
            z-index: 1050;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.9);
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }

        .modal-content {
            max-width: 90%;
            max-height: 80vh;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(255, 255, 255, 0.3);
            display: block;
            margin: 0 auto;
            animation: fadeIn 0.4s ease-in-out;
            object-fit: contain;
        }

        .close {
            position: absolute;
            top: 15px;
            right: 25px;
            color: #fff;
            font-size: 40px;
            font-weight: bold;
            cursor: pointer;
            z-index: 1060;
        }

        .close-button {
            margin-top: 20px;
            background-color: #ffffff;
            color: #000000;
            border: none;
            padding: 10px 20px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
            z-index: 1060;
            transition: background-color 0.3s ease;
        }

        .close-button:hover {
            background-color: #ccc;
        }

        @keyframes fadeIn {
            from {opacity: 0}
            to {opacity: 1}
        }
    </style>

    <h1 style="color: white; text-align: center; margin-top: 50px">Mi Perfil</h1>

    <div class="perfil-container" style="margin-top: 30px;">
        <div id="avatar-profile" class="avatar">
            @if($user->datos && $user->datos->foto_perfil)
                <img src="{{ asset('storage/' . $user->datos->foto_perfil) . '?t=' . time() }}" />
            @else
                <img src="{{ asset('images/usuario.jpg') }}" />
            @endif
        </div>

        <div class="username">{{ $user->name }}</div>

        <div class="d-flex justify-content-center gap-3 my-4 flex-wrap">
            <a href="{{ route('informacion.create') }}" class="btn btn-outline-primary shadow-sm">
                <i class="fas fa-user-edit me-2"></i>Actualizar información
            </a>
            <a href="{{ route('favoritos.index') }}" class="btn btn-outline-warning shadow-sm">
                <i class="fas fa-star me-2"></i>Mis Favoritos
            </a>
            <a href="{{ route('likes.mislikes') }}" class="btn btn-outline-danger shadow-sm">
                <i class="fas fa-heart me-2 text-danger"></i>Mis Likes
            </a>
        </div>

        <div class="row row-cols-1 row-cols-md-2 g-4 mt-4">
            <div class="col">
                <div class="card h-100 shadow bg-success bg-opacity-50 text-white position-relative rounded-4">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fas fa-user me-2"></i>Información Básica</h5>
                        <p><i class="fas fa-id-badge me-2 text-muted"></i><strong>Nombre:</strong> {{ $user->name }}</p>
                        <p><i class="fas fa-envelope me-2 text-muted"></i><strong>Email:</strong> {{ $user->email }}</p>
                        <p><i class="fas fa-heart me-2 text-muted"></i><strong>Preferencias:</strong> {{ $user->datos->preferencias ?? 'Dato no disponible' }}</p>
                        <p><i class="fas fa-user-tag me-2 text-muted"></i><strong>Alias:</strong> {{ $user->datos->alias ?? 'Dato no disponible' }}</p>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card h-100 shadow bg-success bg-opacity-50 text-white position-relative rounded-4">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fas fa-info-circle me-2"></i>Detalles Adicionales</h5>
                        <p><i class="fas fa-phone me-2 text-muted"></i><strong>Teléfono:</strong> {{ $user->datos->telefono ?? 'Dato no disponible' }}</p>
                        <p><i class="fas fa-paw me-2 text-muted"></i><strong>Animal Favorito:</strong> {{ $user->datos->animal_favorito ?? 'Dato no disponible' }}</p>
                        <p><i class="fas fa-briefcase me-2 text-muted"></i><strong>Ocupación:</strong> {{ $user->datos->ocupacion ?? 'Dato no disponible' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <h2 style="color: white; text-align: center; margin-top: 30px;">Mis Publicaciones</h2>

    @if($especies->isEmpty())
        <p class="text-center" style="font-family: 'Roboto', sans-serif; color: rgb(242, 237, 244);">
            No hay publicaciones disponibles.
        </p>
    @else
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach($especies as $especie)
                <div class="col">
                    <a href="{{ route('catalogo.show', $especie->id) }}" class="text-decoration-none">
                        <div class="card h-100 shadow bg-success bg-opacity-50 text-white position-relative rounded-4">
                            @if($especie->image_path)
                                <img src="{{ asset('storage/' . $especie->image_path) }}"
                                     class="card-img-top"
                                     style="height: 200px; object-fit: cover;"
                                     alt="Imagen de {{ $especie->nombre }}">
                            @endif
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title" style="font-family: 'Roboto', sans-serif;">
                                    {{ $especie->nombre }}
                                </h5>
                                <p class="card-text flex-grow-1" style="font-family: 'Roboto', sans-serif;">
                                    <em>{{ $especie->nombre_cientifico }}</em>
                                </p>
                                <span class="custom-badge">Mamíferos (fauna)</span>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    @endif
</div>

{{-- MODAL PARA IMÁGENES --}}
<div id="myModal" class="modal">
    <span class="close" onclick="closeModal()">&times;</span>
    <img class="modal-content" id="img01">
</div>

{{-- SCRIPTS --}}
<script>
    function openModalWithSrc(src) {
        const modal = document.getElementById("myModal");
        const modalImg = document.getElementById("img01");
        modal.style.display = "flex";
        modalImg.src = src;
    }

    function closeModal() {
        document.getElementById("myModal").style.display = "none";
    }

    document.addEventListener("DOMContentLoaded", function () {
        const avatar = document.getElementById("avatar-profile");
        if (avatar) {
            avatar.addEventListener("click", () => {
                const img = avatar.querySelector("img");
                if (img) openModalWithSrc(img.src);
            });
        }

        document.addEventListener("keydown", function (event) {
            if (event.key === "Escape") {
                closeModal();
            }
        });

        const modal = document.getElementById("myModal");
        modal.addEventListener("click", function (event) {
            if (event.target === modal) {
                closeModal();
            }
        });
    });
</script>
@endsection
