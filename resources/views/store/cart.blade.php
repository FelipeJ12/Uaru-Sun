@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <style>
        .text-center {
            margin-top: 80px;
        }
    </style>

    <div class="text-center mb-4">
        <h1 class="text-3xl font-bold text-center text-green-700 mb-10" style="color: white">Mi Carrito</h1>
    </div>

    @if (count($cart) > 0)
        <div class="bg-white rounded-lg shadow p-6 overflow-x-auto">
            <table class="w-full text-left">
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
                                <form action="{{ route('cart.update', $id) }}" method="POST" class="flex items-center gap-2">
                                    @csrf
                                    @method('PUT')
                                    <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1"
                                           class="w-16 border border-gray-300 rounded px-2 py-1">
                                    <button type="submit"
                                            class="bg-blue-500 hover:bg-blue-600  px-3 py-1 rounded">
                                        Actualizar
                                    </button>
                                </form>
                            </td>
                            <td class="py-2 px-4 border-b">L {{ number_format($subtotal, 2) }}</td>
                            <td class="py-2 px-4 border-b">
                                <form action="{{ route('cart.remove', $id) }}" method="POST"
                                      onsubmit="return confirm('¿Estás seguro de que deseas eliminar este producto?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="bg-red-500 hover:bg-red-600  px-3 py-1 rounded">
                                        Eliminar
                                    </button>
                                </form>
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

            <!-- ✅ Botón para proceder al pago -->
<div class="mt-6 text-right">
    <form action="{{ route('checkout.index') }}" method="GET">
        <button type="submit"
                class="bg-green-600 hover:bg-green-700 font-semibold px-6 py-2 rounded-lg transition">
            Proceder al pago
        </button>
    </form>
</div>

        </div>
    @else
        <p class="text-center text-gray-600">Tu carrito está vacío.</p>
    @endif
</div>
@endsection
