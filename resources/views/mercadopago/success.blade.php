
@extends('layout.navbar')
@section('title', 'Checkout')

@section('main')
    <h1 class="titleColorBg">Compra realizada con exito!</h1>

    <p>La compra fue completada con exito! Hace click en el boton de abajo para ver la compra en tu perfil:</p>
    
    <a class="btn boton2" href="{{ route('perfil', ['id' => auth()->user()->user_id]) }}">Ir a mi perfil</a>
@endsection
