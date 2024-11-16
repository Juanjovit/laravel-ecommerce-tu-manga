@extends('layout.navbar')

@section('title', 'Carrito')

@section('main')
    <h1 class="titleColorBg">Carrito</h1>

    <table class="table">
        <thead>
            <tr>
                <th></th>
                <th>Producto</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Subtotal</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($cart->getItems() as $item)
                <tr>
                    <td> 
                        @if($item->getProduct()->cover !== null && Storage::has('imgs/' . $item->getProduct()->cover))
                            <img src="{{ Storage::url('imgs/' . $item->getProduct()->cover) }}" alt="{{ $alt ?? $item->getProduct()->cover_description }}" class="w-25">
                        @else
                            <img src="{{ Storage::url('imgs/' . 'imagenNoDisponible.jpg') }}" alt="imagen no disponible" class="w-25">
                        @endif  
                    </td>
                    <td>{{ $item->getProduct()->title }}</td>
                    <td>${{ $item->getPrice() }}</td>
                    <td>{{ $item->getQuantity() }}</td>
                    <td>${{ $item->getSubtotal() }}</td>
                    <td>
                        <form action="{{ route('carrito.update', $item->getId()) }}" method="POST" >
                            @csrf
                            <div class="d-flex">
                                <input class="form-control carritoInput me-1" type="number" name="quantity" value="{{ $item->getQuantity() }}" min="1">
                                <button class="btn boton2" type="submit">Cambiar cantidad</button>
                            </div>

                        </form>
                        <form action="{{ route('carrito.remove', $item->getId()) }}" method="POST" class="mt-2">
                            @csrf
                            <button class="btn boton2" type="submit">Quitar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2>Total: ${{ $cart->getTotal() }}</h2>

    @if(count($cart->getItems()) > 0)
        <a href="{{ route('mercadopago.show') }}" class="btn boton1 w-100">Comprar</a>
    @else
        <p>Tu carrito esta vacio. Anda a la seccion shop para ver nuestros productos!</p>
        <a href="{{ route('shop') }}" class="btn boton2 w-100">Shop</a>
    @endif

@endsection
