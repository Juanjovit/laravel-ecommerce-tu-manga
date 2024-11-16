<?php

namespace App\Http\Controllers;

use App\Models\Manga;
use App\PaymentProviders\MercadoPagoPayment;
use Illuminate\Http\Request;
use App\Cart\Cart;
use App\Models\Purchases;

class MercadoPagoController extends Controller
{
    public function show(Request $request)
    {

        $cart = $request->session()->get('cart', new Cart());
        $items = $cart->getItems();

        $payment = new MercadoPagoPayment();
        $payment
        ->addItems($items)
        ->withBackUrls(
                success: route('mercadopago.success'),
                pending: route('mercadopago.pending'),
                failure: route('mercadopago.failure'),
            )
            ->withAutoReturn()
            ->save();


        return view('mercadopago.show', [
            'items' => $items,
            'payment' => $payment,
        ]);
    }

    public function processSuccess(Request $request)
    {

        $user = auth()->user();  
        $cart = $request->session()->get('cart', new Cart());

        if ($cart->isEmpty()) {
            return redirect()->route('home');
        }

        $purchase = new Purchases([
            'total_price' => $cart->getTotal(),
            'purchase_date' => now(),
            'user_fk' => $user->user_id,
        ]);

        $purchase->save();

        foreach ($cart->getItems() as $item) {
            $purchase->mangas()->attach
            (
                $item->getProduct()->id, ['quantity' => $item->getQuantity()]
            );
        }

        $request->session()->forget('cart');

        return view('mercadopago.success');
    }

    public function processPending(Request $request)
    {
        return view('mercadopago.pending');
    }

    public function processFailure(Request $request)
    {
        return view('mercadopago.failure');
    }
}
