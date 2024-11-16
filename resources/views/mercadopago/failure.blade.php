
@extends('layout.navbar')
@section('title', 'Checkout')

@section('main')
    <h1 class="titleColorBg">Pago rechazado</h1>

    <p>Hubo un error. Todavia esta tu carrito, volve a intentarlo mas tarde.</p>
    
    <a class="btn boton2" href="{{ route('home') }}">Volver al inicio</a>
@endsection
