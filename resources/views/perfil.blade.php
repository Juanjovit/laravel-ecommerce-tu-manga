<?php
/** @var \App\Models\User[]|\Illuminate\Database\Eloquent\Collection $usuario */
?>

@extends('layout.navbar')
@section('title', 'Perfil de ' . $usuario->email)

@section('main')
    <h1 class="titleColorBg">Perfil de {{ $usuario->email }}</h1>

    <a class="btn boton1 mt-3 mb-5" href="{{ route('editarPassword', ['id' => $usuario->user_id]) }}">Editar Password</a>

    <h2>Mis Compras</h2>

        @foreach($compras as $compra)
          <div class="card p-2 my-2 flex-row justify-content-between mx-3">
            <div class="">
                @if($compra->mangas->isNotEmpty() && $compra->mangas[0]->cover !== null && Storage::has('imgs/' . $compra->mangas[0]->cover))
                    <img src="{{ Storage::url('imgs/' . $compra->mangas[0]->cover) }}" alt="{{ $alt ?? $compra->mangas[0]->cover_description }}" class="w-25">
                @else
                    <img src="{{ Storage::url('imgs/' . 'imagenNoDisponible.jpg') }}" alt="imagen no disponible" class="imgLoSentimos w-25">
                @endif   
            </div>
            <div class="m-auto w-25">
                <p>Total: ${{ $compra->total_price }}</p>
                <p>Fecha: {{ $compra->purchase_date }}</p>
            </div>
            <div class="d-flex align-items-center">
                <a href="{{ route('verCompra' , ['id' => $usuario->user_id, 'compra_id' => $compra->id]) }}" class="btn boton1 m-1">Ver</a>
            </div>

          </div>
        @endforeach
@endsection