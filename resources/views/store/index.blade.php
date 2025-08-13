@php
    $title = 'Tienda'; 
@endphp

@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 py-10 bg-gradient-to-b from-green-900 via-green-800 to-green-700 min-h-screen">

    <style>
        .text-center {
            margin-top: 80px;
        }

        .imagen-fija {
            width: 380px;
            height: 300px;
            object-fit: cover;
            display: block;
            margin-left: auto;
            margin-right: auto;
            border-radius: 1rem 1rem 0 0;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease;
        }

        .product-card {
            background: #ffffffdd; /* blanco con transparencia */
            border-radius: 1.25rem;
            box-shadow:
                0 8px 15px rgba(0, 0, 0, 0.15);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            display: flex;
            flex-direction: column;
            align-items: center;
            border: 1px solid #d1d5db;
            overflow: hidden;
        }

        .product-card:hover {
            transform: translateY(-8px) scale(1.05);
            box-shadow: 0 16px 30px rgba(0, 0, 0, 0.3);
            border-color: #22c55e; /* verde vivo */
        }

        .product-info {
            padding: 1.5rem;
            width: 100%;
            text-align: center;
        }

        .product-name {
            font-size: 1.375rem; /* 22px */
            font-weight: 700;
            color: #065f46; /* verde oscuro */
            margin-bottom: 0.5rem;
            text-shadow: 0 1px 2px rgba(0,0,0,0.1);
        }

        .product-description {
            font-size: 0.875rem; /* 14px */
            color: #4b5563; /* gris medio */
            margin-bottom: 1rem;
            min-height: 3rem;
        }

        .product-price {
            font-size: 1.25rem;
            font-weight: 700;
            color: #16a34a; /* verde */
            margin-bottom: 1.25rem;
        }

        .btn-add {
            width: 100%;
            background: linear-gradient(135deg, #22c55e, #16a34a);
            color: white;
            font-weight: 700;
            padding: 0.6rem 0;
            border-radius: 0.75rem;
            box-shadow: 0 4px 12px rgba(22, 163, 74, 0.6);
            transition: background 0.3s ease, box-shadow 0.3s ease;
            border: none;
            cursor: pointer;
        }

        .btn-add:hover {
            background: linear-gradient(135deg, #16a34a, #15803d);
            box-shadow: 0 6px 18px rgba(21, 128, 61, 0.8);
        }

        /* Modal styling */
        .modal-content {
            border-radius: 1rem;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0,0,0,0.25);
        }

        .modal-header, .modal-footer {
            background-color: #f9fafb;
            border: none;
            padding: 1.25rem 1.5rem;
        }

        .modal-title {
            font-weight: 700;
            color: #065f46;
            font-size: 1.25rem;
        }

        .modal-body p {
            color: #374151;
            font-size: 1rem;
        }

        .btn-close {
            background: transparent;
            border: none;
            font-size: 1.5rem;
            color: #6b7280;
            cursor: pointer;
        }

        .btn-secondary {
            background-color: #e5e7eb;
            color: #374151;
            padding: 0.5rem 1.5rem;
            border-radius: 0.5rem;
            font-weight: 600;
            border: none;
            transition: background-color 0.3s ease;
        }

        .btn-secondary:hover {
            background-color: #d1d5db;
        }

        .btn-primary {
            background-color: #22c55e;
            color: white;
            padding: 0.5rem 1.5rem;
            border-radius: 0.5rem;
            font-weight: 700;
            border: none;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #16a34a;
        }

        /* Responsive tweaks */
        @media (max-width: 640px) {
            .imagen-fija {
                width: 100%;
                height: 240px;
            }
        }
    </style>

    <div class="text-center mb-12">
        <h1 class="text-5xl font-extrabold text-white drop-shadow-lg select-none">
            🌿 Tienda de Flora Hondureña
        </h1>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-10">
        @foreach ($products as $product)
            <div class="product-card">
                @if($product->image)
                    <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}" class="imagen-fija" />
                @else
                    <div class="imagen-fija bg-gray-100 flex items-center justify-center text-gray-400 font-semibold rounded-t-2xl">
                        Sin imagen
                    </div>
                @endif

                <div class="product-info">
                    <h2 class="product-name">{{ $product->name }}</h2>
                    <p class="product-description">{{ $product->description }}</p>
                    <p class="product-price">L {{ number_format($product->price, 2) }}</p>

                    <button 
            type="button" 
            class="btn-add"
            onclick="document.getElementById('confirmPanel-{{ $product->id }}').style.display = 'block';"
        >
                        Agregar al carrito
                    </button>

                    <!-- Modal -->
<!-- Panel fijo (no flotante) -->
<div id="confirmPanel-{{ $product->id }}" style="display:none; margin-top: 1rem; padding: 1rem; border: 2px solid #22c55e; border-radius: 12px; background-color: #e6f4ea;">
            <p style="color: red;">¿Estás seguro de que deseas agregar este producto al carrito?</p>
            <div style="margin-top: 1rem; display: flex; justify-content: space-between;">
                <button 
                    type="button" 
                    onclick="document.getElementById('confirmPanel-{{ $product->id }}').style.display = 'none';"
                    style="background: #e5e7eb; border: none; padding: 0.5rem 1rem; border-radius: 8px; cursor: pointer;"
                >Cancelar</button>

                <form action="{{ route('cart.add', $product->id) }}" method="POST" style="margin:0;">
                    @csrf
                    <button type="submit" style="background: #22c55e; color: white; border: none; padding: 0.5rem 1rem; border-radius: 8px; cursor: pointer;">Agregar</button>
                </form>
            </div>
        </div>

                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Selecciona todos los formularios con un ID que empieza con "add-to-cart-form-"
        const forms = document.querySelectorAll('[id^="add-to-cart-form-"]');

        forms.forEach(form => {
            form.addEventListener('submit', function (e) {
                e.preventDefault(); // Evita la recarga de la página

                const formId = this.id;
                const modalId = formId.replace('add-to-cart-form-', 'confirmModal-');
                const modalElement = document.getElementById(modalId);

                // Envía los datos del formulario de forma asíncrona
                fetch(this.action, {
                    method: this.method,
                    body: new FormData(this),
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Cierra el modal de Bootstrap después de una respuesta exitosa
                        const modal = bootstrap.Modal.getOrCreateInstance(modalElement);

                        modal.hide();
                        
                        // Opcional: Muestra una alerta o notificación al usuario
                        alert('¡Producto agregado al carrito exitosamente!');
                    } else {
                        console.error('Hubo un problema al agregar el producto:', data.message);
                        alert('Error: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Ocurrió un error al procesar la solicitud.');
                });
            });
        });
    });
</script>
@endpush