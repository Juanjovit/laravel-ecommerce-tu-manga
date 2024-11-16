<?php
/** @var \App\Models\Manga $manga */
?>

@extends('layout.navbar')
@section('title', $manga->title)

@section('main')
    <article>
        <div class="row mb-3 m-auto">
            <div class="col-sm-5 col-lg-4">
                @if($manga->cover !== null && Storage::has('imgs/' . $manga->cover))
                    <img src="{{ Storage::url('imgs/' . $manga->cover) }}" alt="{{ $alt ?? $manga->cover_description }}" class="w-100">
                @else
                    <img src="{{ Storage::url('imgs/' . 'imagenNoDisponible.jpg') }}" alt="imagen no disponible" class="w-100">
                @endif     
            </div>
            <div class="col">
                <h1 class="mb-3 titleColorBg">{{ $manga->title }}</h1>
                <ul>
                    <li>{{ $manga->en_alternative_title }}</li>
                    <li>{{ $manga->es_alternative_title }}</li>
                    <li>{{ $manga->serie->title }}</li>
                    <li>{{ $manga->synopsis }}</li>
                    <li>Fecha de Publicacion: {{ $manga->release_date }}</li>
                    <li>${{ $manga->price }}</li>
                </ul>
                <form action="{{ route('carrito.add', ['id' => $manga->id]) }}" method="POST" class="ms-5">
                    @csrf
                    <button type="submit" class="btn boton2 d-grid mt-5  w-100">Añadir al carro</button>
                </form>
            </div>
        </div>
    </article>
@endsection
