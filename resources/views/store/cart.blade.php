@php
    $title = 'Mi Carrito'; 
@endphp

@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <style>
        .btn-custom, 
        button.bg-green-600, 
        button.bg-blue-500, 
        button.bg-red-500, 
        a.bg-blue-500 {
            display: inline-block;
            width: 100%;
            max-width: fit-content;
            padding: 12px 20px;
            font-size: 16px;
            font-weight: 600;
            border: none;
            border-radius: 9999px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            letter-spacing: 0.5px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease, box-shadow 0.2s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
            color: white;
        }

        .btn-custom:active,
        button.bg-green-600:active,
        button.bg-blue-500:active,
        button.bg-red-500:active,
        a.bg-blue-500:active {
            transform: scale(0.98);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        }

        button.bg-green-600 {
            background: linear-gradient(135deg, #16a34a, #15803d);
            box-shadow: 0 4px 12px rgba(22, 163, 74, 0.3);
        }

        button.bg-green-600:hover {
            background: linear-gradient(135deg, #15803d, #166534);
            transform: scale(1.03);
        }

        a.bg-blue-500, 
        button.bg-blue-500 {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }

        a.bg-blue-500:hover, 
        button.bg-blue-500:hover {
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            transform: scale(1.03);
        }

        button.bg-red-500 {
            background: linear-gradient(135deg, #ef4444, #b91c1c);
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
        }

        button.bg-red-500:hover {
            background: linear-gradient(135deg, #b91c1c, #7f1d1d);
            transform: scale(1.03);
        }

        .text-center {
            margin-top: 80px;
        }

        .contenedor {
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }

        .informacion, .carrito {
            flex: 1 1 100%;
        }

        @media (min-width: 768px) {
            .contenedor {
                flex-direction: row;
                flex-wrap: wrap;
            }
            .informacion {
                flex: 1 1 100%;
            }
        }

        @media (min-width: 1024px) {
            .informacion {
                flex: 1 1 30%;
                margin-right: 20px;
            }
            .carrito {
                flex: 1 1 65%;
            }
        }

        .informacion {
            color: white;
        }

        .carrito {
            background-color: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow-x: auto;
        }

        .imagen-metodos {
            width: 100%;
            max-width: 200px;
            height: auto;
            margin-top: 10px;
        }

        table {
            width: 100%;
            min-width: 600px;
        }

        input[type="number"] {
            width: 70px;
        }

        @media (max-width: 768px) {
            .mt-6.flex {
                flex-direction: column;
                align-items: stretch;
            }

            .mt-6.flex form,
            .mt-6.flex a {
                width: 100%;
            }
        }
    </style>

    <div class="contenedor">
        <div class="informacion">
            <h3>Opciones de pago seguro</h3>
            <p>Uaru Sun se compromete a proteger tu información de pago...</p>
            <h4>1. Métodos de pago</h4>
            <img src="{{ asset('images/pagos.jpeg') }}" alt="Métodos de Pago" class="imagen-metodos">
            <h4>2. Certificación de seguridad</h4>
            <h3>Privacidad segura</h3>
            <p>Proteger tu privacidad es muy importante para nosotros...</p>
            <h3>Protección de compras en Uaru Sun</h3>
            <p>Compra con confianza...</p>
            <h4 class="font-bold">4. Programa de plantación de árboles</h4>
            <p>Por cada compra que realizas, apoyas nuestro programa de reforestación.</p>
        </div>

        <div class="carrito">
            @if (count($cart) > 0)
                <table class="text-left text-sm">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 border-b">Producto</th>
                            <th class="py-2 px-4 border-b">Precio</th>
                            <th class="py-2 px-4 border-b">Cantidad</th>
                            <th class="py-2 px-4 border-b">Subtotal</th>
                            <th class="py-2 px-4 border-b">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $total = 0; @endphp
                        @foreach ($cart as $id => $item)
                            @php
                                $subtotal = $item['price'] * $item['quantity'];
                                $total += $subtotal;
                            @endphp
                            <tr>
                                <td class="py-2 px-4 border-b">{{ $item['name'] }}</td>
                                <td class="py-2 px-4 border-b">L {{ number_format($item['price'], 2) }}</td>
                                <td class="py-2 px-4 border-b">
                                    <form action="{{ route('cart.update', $id) }}" method="POST" class="flex flex-wrap items-center gap-2">
                                        @csrf
                                        @method('PUT')
                                        <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="border border-gray-300 rounded px-2 py-1">
                                        <button type="submit" class="bg-blue-500 hover:bg-blue-600 px-3 py-1 rounded">Actualizar</button>
                                    </form>
                                </td>
                                <td class="py-2 px-4 border-b">L {{ number_format($subtotal, 2) }}</td>
                                <td class="py-2 px-4 border-b">
                                    <button type="button" class="bg-red-500 hover:bg-red-600 px-3 py-1 rounded" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal-{{ $id }}">
                                        Eliminar
                                    </button>

                                    <div class="modal fade" id="confirmDeleteModal-{{ $id }}" tabindex="-1" aria-labelledby="confirmDeleteModalLabel-{{ $id }}" aria-hidden="true">
                                      <div class="modal-dialog">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h5 class="modal-title" id="confirmDeleteModalLabel-{{ $id }}">Confirmar eliminación</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                          </div>
                                          <div class="modal-body">
                                            ¿Estás seguro de que deseas eliminar <strong>{{ $item['name'] }}</strong> del carrito?
                                          </div>
                                          <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                            <form action="{{ route('cart.remove', $id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Eliminar</button>
                                            </form>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="text-right font-bold py-2 px-4">Total:</td>
                            <td class="font-bold py-2 px-4">L {{ number_format($total, 2) }}</td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>

                <div class="mt-6 flex flex-col md:flex-row justify-between gap-4">
                    <form action="{{ route('checkout.index') }}" method="GET">
                        <button type="submit" class="bg-green-600 hover:bg-green-700 font-semibold px-6 py-2 rounded-lg transition w-full md:w-auto">Proceder al pago</button>
                    </form>
                    <a href="{{ route('store') }}" class="bg-blue-500 hover:bg-blue-600 transition duration-200 font-semibold py-3 px-6 rounded-xl shadow text-center w-full md:w-auto">Volver a Tienda</a>
                </div>
            @else
                <div class="flex flex-col items-center justify-center text-center py-20">
                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 1024 1024" width="80" height="80" fill="#aaaaaa" aria-hidden="true">
                        <path d="..."></path>
                    </svg>
                    <div class="mt-6 text-xl text-gray-700 font-semibold">El carrito de compras está vacío</div>
                    <div class="text-gray-500 mb-6">Agrega tus artículos favoritos.</div>
                    <a href="{{ route('store') }}" class="bg-blue-500 hover:bg-blue-600 transition duration-200 font-semibold py-3 px-6 rounded-xl shadow">Volver a Tienda</a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
