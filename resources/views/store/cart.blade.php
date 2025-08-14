@php
$items = [
    ['label' => 'Inicio', 'url' => route('home')],
    ['label' => 'Tienda', 'url' => route('store')],
    ['label' => 'Carrito']
];
$title = 'Mi Carrito';
@endphp

@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <style>
        /* BOTONES GENERALES */
        .btn {
            display: inline-block;
            font-weight: 600;
            border-radius: 9999px;
            padding: 0.5rem 1rem;
            cursor: pointer;
            text-align: center;
            transition: all 0.2s ease;
        }
        .btn-green { background: #16a34a; color: white; }
        .btn-green:hover { background: #15803d; transform: scale(1.05); }
        .btn-blue { background: #3b82f6; color: white; }
        .btn-blue:hover { background: #2563eb; transform: scale(1.05); }
        .btn-red { background: #ef4444; color: white; }
        .btn-red:hover { background: #b91c1c; transform: scale(1.05); }

        /* CONTENEDOR PRINCIPAL */
        .contenedor {
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }
        @media(min-width:1024px){
            .contenedor { flex-direction: row; align-items: flex-start; }
        }

        .informacion {
            flex: 1;
            color: white;
        }

        .carrito {
            flex: 1;
            background-color: rgba(25,135,84,0.5);
            color: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            overflow-x:auto;
        }

        .imagen-metodos { width: 100%; max-width: 200px; height:auto; margin-top:10px; }

        table { width: 100%; border-collapse: separate; border-spacing: 0 0.5rem; color: white; }
        th, td { padding: 0.5rem 1rem; }

        /* CANTIDAD CON + Y - */
        .quantity-control {
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }
        .quantity-control button {
            padding: 0.25rem 0.5rem;
            font-weight: bold;
            border-radius: 6px;
            border: none;
            background: #f3f4f6;
            cursor: pointer;
            transition: background 0.2s;
        }
        .quantity-control button:hover { background: #e5e7eb; }
        .quantity-control input {
            width: 3rem;
            text-align: center;
            border-radius: 6px;
            border: none;
            outline: none;
        }

        @media(max-width:768px){
            .contenedor { flex-direction: column; }
        }
    </style>

    <div class="contenedor">
        <!-- OPCIONES DE PAGO -->
        <div class="informacion">
            <h3 class="text-xl font-semibold mb-2">Opciones de pago seguro</h3>
            <p>Uaru Sun se compromete a proteger tu información de pago...</p>
            <h4 class="font-semibold mt-4">1. Métodos de pago</h4>
            <img src="{{ asset('images/pagos.jpeg') }}" alt="Métodos de Pago" class="imagen-metodos">
            <h4 class="font-semibold mt-4">2. Certificación de seguridad</h4>
            <p>Proteger tu privacidad es muy importante para nosotros...</p>
            <h4 class="font-semibold mt-4">3. Protección de compras en Uaru Sun</h4>
            <p>Compra con confianza...</p>
            <h4 class="font-semibold mt-4">4. Programa de plantación de árboles</h4>
            <p>Por cada compra que realizas, apoyas nuestro programa de reforestación.</p>
        </div>

        <!-- CARRITO -->
        <div class="carrito">
            @php $total = 0; @endphp
            @if(count($cart) > 0)
                <table>
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Subtotal</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cart as $id => $item)
                            @php
                                $subtotal = $item['price'] * $item['quantity'];
                                $total += $subtotal;
                            @endphp
                            <tr>
                                <td>{{ $item['name'] }}</td>
                                <td>L {{ number_format($item['price'],2) }}</td>
                                <td>
                                    <form action="{{ route('cart.update',$id) }}" method="POST">
                                        @csrf @method('PUT')
                                        <div class="quantity-control">
                                            <button type="button" onclick="updateQuantity(this,-1)">−</button>
                                            <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" readonly>
                                            <button type="button" onclick="updateQuantity(this,1)">+</button>
                                        </div>
                                        <button type="submit" class="btn btn-blue mt-1">Actualizar</button>
                                    </form>
                                </td>
                                <td>L {{ number_format($subtotal,2) }}</td>
                                <td>
                                    <!-- Botón eliminar con modal -->
                                    <button type="button" class="btn btn-red" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal-{{ $id }}">
                                        Eliminar
                                    </button>

                                    <div class="modal fade text-black" id="confirmDeleteModal-{{ $id }}" tabindex="-1" aria-labelledby="confirmDeleteModalLabel-{{ $id }}" aria-hidden="true">
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
                                                <button type="submit" class="btn btn-red">Eliminar</button>
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
                            <td colspan="3" class="text-right font-bold">Total:</td>
                            <td class="font-bold">L {{ number_format($total,2) }}</td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>

                <div class="mt-6 flex flex-col md:flex-row gap-4">
                    <form action="{{ route('checkout.index') }}" method="GET">
                        <button type="submit" class="btn btn-green w-full md:w-auto">Proceder al pago</button>
                    </form>
                    <a href="{{ route('store') }}" class="btn btn-blue w-full md:w-auto text-center">Volver a Tienda</a>
                </div>
            @else
                <div class="flex flex-col items-center justify-center text-center py-20">
                    <p class="mt-6 text-xl font-semibold text-white">Tu carrito está vacío 🛒</p>
                        <p class="text-gray-200 mb-6">Agrega tus artículos favoritos y apoya nuestro programa de reforestación 🌱</p>
                    <a href="{{ route('store') }}" class="btn btn-blue mt-4">Volver a Tienda</a>
                </div>
            @endif
        </div>
    </div>
</div>

<script>
function updateQuantity(button, change){
    let input = button.parentElement.querySelector('input[type="number"]');
    let value = parseInt(input.value);
    value += change;
    if(value < 1) value = 1;
    input.value = value;
}
</script>
@endsection
