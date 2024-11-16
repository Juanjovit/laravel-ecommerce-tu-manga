<?php
/** @var \App\Models\Manga[]|\Illuminate\Database\Eloquent\Collection $mangas */
/** @var \App\PaymentProviders\MercadoPagoPayment $payment */
?>
@extends('layout.navbar')
@section('title', 'Checkout')

@section('main')
<h1 class="titleColorBg">Checkout</h1>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
                <tr>
                    <td>{{ $item->getProduct()->title }}</td>
                    <td>$ {{ $item->getPrice() }}</td>
                    <td>{{ $item->getQuantity() }}</td>
                    <td>$ {{ $item->getSubtotal() }}</td>
                </tr>
            @endforeach
                <tr>
                    <td colspan="3"><b>Total:</b></td>
                    <td>$ {{ $payment->getTotal() }}</td>
                </tr>
        </tbody>
    </table>

    <div id="mercadopago"></div>

    <script src="https://sdk.mercadopago.com/js/v2"></script>
    <script>
        const mp = new MercadoPago("<?= $payment->getPublicKey();?>");
        mp.bricks().create('wallet', 'mercadopago', {
            initialization: {
                preferenceId: "<?= $payment->getPreferenceId();?>"
            }
        });
    </script>
@endsection
