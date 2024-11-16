<?php
/** @var \App\Models\News $noticia */
?>

@extends('layout.navbar')

@section('title', "Eliminar permanentemente el noticia " . $noticia->title)

@section('main')

<div class="mb-3">
    <a href="{{ route('admin.trashed.noticias.index') }}">Volver</a>
</div>

    <article class="mb-3">
        <div class="row flex-row-reverse mb-3">
            <div class="col-9">
                <h1 class="mb-3 titleColorBg">{{ $noticia->title }}</h1>
                <h2 class="mb-3">{{ $noticia->resume }}</h2>
                <p class="mb-3">{{ $noticia->article }}</p>
            </div>
            <div class="col-3">
                <img src="{{ Storage::url('imgs/' . $noticia->image) }}" alt="{{ $alt ?? $noticia->image_description }}" class="w-100">
            </div>
        </div>

        <h2 class="mb-3">Sinopsis</h2>
        {{ $noticia->synopsis }}
    </article>

    <form action="{{ route('admin.trashed.noticias.processTrashDeleteNoticia', ['id' => $noticia->id]) }}" method="post">
        @csrf
        <h2 class="mb-3">Confirmación Necesaria</h2>
        <h2>¿Desea eliminar esta noticia de forma permanente? Una vez eliminada no se puede revertir.</h2>

        <button type="submit" class="btn boton2">Eliminar permanentemente</button>
    </form>
@endsection
