<?php
/** @var \App\Models\News $noticia */
?>

@extends('layout.navbar')

@section('title', "Confirmación Eliminar Noticia " . $noticia->title)

@section('main')

<div class="mb-3">
    <a href="{{ route('admin.dashboard') }}">Volver</a>
</div>

    <article class="mb-3">
        <div class="row flex-row-reverse mb-3">
            <div class="col-9">
                <h1 class="mb-3 titleColorBg">{{ $noticia->title }}</h1>
                <h2 class="mb-3">{{ $noticia->resume }}</h2>
                <p class="mb-3">{{ $noticia->article }}</p>
            </div>
            <div class="col-3">
                @if($noticia->image !== null && Storage::has('imgs/' . $noticia->image))
                    <img src="{{ Storage::url('imgs/' . $noticia->image) }}" alt="{{ $alt ?? $noticia->image_description }}" class="w-100">
                @else
                    <img src="{{ Storage::url('imgs/' . 'imagenNoDisponible2.jpg') }}" alt="imagen no disponible" class="w-100">
                @endif        
            </div>
        </div>

        <h2 class="mb-3">Sinopsis</h2>
        {{ $noticia->synopsis }}
    </article>



    <form action="{{ route('admin.processDeleteNoticia', ['id' => $noticia->id]) }}" method="post">
        @csrf
        <h2>¿Desea eliminar este noticia? Sera enviada a la papelera.</h2>
        <button type="submit" class="btn boton2">Eliminar</button>
    </form>
@endsection
