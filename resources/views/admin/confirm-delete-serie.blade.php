<?php
/** @var \App\Models\Serie $serie */
?>

@extends('layout.navbar')

@section('title', "Confirmación Eliminar Serie " . $serie->title)

@section('main')

<div class="mb-3">
    <a href="{{ route('admin.dashboard') }}">Volver</a>
</div>

    <article class="mb-3">
        <div class="row flex-row-reverse mb-3">
            <div class="col-9">
                <h1 class="mb-3 titleColorBg">{{ $serie->title }}</h1>
            </div>
            <div class="col-3">
                @if($serie->image !== null && Storage::has('imgs/' . $serie->image))
                    <img src="{{ Storage::url('imgs/' . $serie->image) }}" alt="{{ $alt ?? $serie->image_description }}" class="w-100">
                @else
                    <img src="{{ Storage::url('imgs/' . 'imagenNoDisponible.jpg') }}" alt="imagen no disponible" class="w-100">
                @endif      
            </div>
        </div>
    </article>



    <form action="{{ route('admin.processDeleteSerie', ['id' => $serie->id]) }}" method="post">
        @csrf
        <h2>PRECAUCION</h2>
        <h3>¿Desea eliminar esta serie y TODOS los mangas relacioandas a la misma? Esta accion no se puede deshacer</h3>
        <button type="submit" class="btn boton2">Eliminar Permanentemente</button>
    </form>
@endsection
