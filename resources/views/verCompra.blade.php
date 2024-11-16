<?php
/** @var \App\Models\User[]|\Illuminate\Database\Eloquent\Collection $usuario */
?>

@extends('layout.navbar')
@section('title', 'Detalles de compra')

@section('main')
    <h1 class="titleColorBg">Detalles de compra</h1>
    <a href="{{ route('perfil' , ['id' => $usuario->user_id]) }}" class="btn boton1 m-1">Volver</a>

            @foreach($compra->mangas as $manga)
            <div class="card p-2 my-2 flex-row align-items-center mx-3">
                <div class="w-25">
                    @if($manga->cover !== null && Storage::has('imgs/' . $manga->cover))
                        <img src="{{ Storage::url('imgs/' . $manga->cover) }}" alt="{{ $alt ?? $manga->cover_description }}" class="w-25">
                    @else
                        <img src="{{ Storage::url('imgs/' . 'imagenNoDisponible.jpg') }}" alt="imagen no disponible" class="w-25">
                    @endif  
                </div>
                <div>
                    <p>{{ $manga->title }}</p>
                    <p>${{ $manga->price }}</p>
                    <p>Cantidad: {{ $manga->pivot->quantity }}</p>
                </div>
            </div>
 
            @endforeach

            




@endsection