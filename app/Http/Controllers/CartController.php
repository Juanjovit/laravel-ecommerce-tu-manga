<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart\Cart;
use App\Cart\CartItem;
use App\Models\Manga;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $cart = $this->getCart($request);

        return view('carrito.index', ['cart' => $cart]);
    }

    public function add(Request $request, $id)
    {
        $manga = Manga::findOrFail($id);
        $cart = $this->getCart($request);

        $cart->addItem(new CartItem($manga));

        $this->saveCart($request, $cart);

        return redirect()->route('carrito.index');
    }

    public function remove(Request $request, $id)
    {
        $cart = $this->getCart($request);

        $cart->removeItem($id);

        $this->saveCart($request, $cart);

        return redirect()->route('carrito.index');
    }

    public function update(Request $request, $id)
    {
        $cart = $this->getCart($request);
        $quantity = $request->input('quantity');

        $cart->setQuantity($id, $quantity);

        $this->saveCart($request, $cart);

        return redirect()->route('carrito.index');
    }

    private function getCart(Request $request): Cart
    {
        return $request->session()->get('cart', new Cart());
    }

    private function saveCart(Request $request, Cart $cart): void
    {
        $request->session()->put('cart', $cart);
    }
}
