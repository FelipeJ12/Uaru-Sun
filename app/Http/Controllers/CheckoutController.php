<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = 0;

        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('checkout.index', compact('cart', 'total'));
    }

    public function process()
    {
        // Esta función se puede dejar si no estás usando Stripe aún
        session()->forget('cart');
        return redirect()->route('home')->with('success', '¡Compra realizada con éxito!');
    }



    // ✅ Método nuevo para procesar con Stripe
    public function payWithStripe(Request $request)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        $cart = session()->get('cart', []);
        $lineItems = [];

        foreach ($cart as $item) {
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'hnl', // cambia a 'usd' si lo necesitas
                    'product_data' => [
                        'name' => $item['name'],
                    ],
                    'unit_amount' => intval($item['price'] * 100), // en centavos
                ],
                'quantity' => $item['quantity'],
            ];
        }

        $session = StripeSession::create([
            'payment_method_types' => ['card'],
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('checkout.success'),
            'cancel_url' => route('checkout.cancel'),
        ]);

        return redirect($session->url);
    }

    public function success()
    {
        session()->forget('cart');
        return redirect()->route('home')->with('success', 'Pago completado con Stripe.');
    }
}
