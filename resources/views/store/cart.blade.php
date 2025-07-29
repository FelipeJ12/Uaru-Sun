@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-center text-green-700 mb-10">Mi Carrito</h1>

    @if (count($cart) > 0)
        <div class="bg-white rounded-lg shadow p-6">
            <table class="w-full text-left">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b">Producto</th>
                        <th class="py-2 px-4 border-b">Precio</th>
                        <th class="py-2 px-4 border-b">Cantidad</th>
                        <th class="py-2 px-4 border-b">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = 0; @endphp
                    @foreach ($cart as $item)
                        @php
                            $subtotal = $item['price'] * $item['quantity'];
                            $total += $subtotal;
                        @endphp
                        <tr>
                            <td class="py-2 px-4 border-b">{{ $item['name'] }}</td>
                            <td class="py-2 px-4 border-b">L {{ number_format($item['price'], 2) }}</td>
                            <td class="py-2 px-4 border-b">{{ $item['quantity'] }}</td>
                            <td class="py-2 px-4 border-b">L {{ number_format($subtotal, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3" class="text-right font-bold py-2 px-4">Total:</td>
                        <td class="font-bold py-2 px-4">L {{ number_format($total, 2) }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    @else
        <p class="text-center text-gray-600">Tu carrito está vacío.</p>
    @endif
</div>
@endsection
