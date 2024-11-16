<?php
/** @var \App\Models\Manga $manga */
?>

@extends('layout.navbar')

@section('title', "Eliminar permanentemente el manga " . $manga->title)

@section('main')

<div class="mb-3">
    <a href="{{ route('admin.trashed.mangas.index') }}">Volver</a>
</div>

    <article class="mb-3">
        <div class="row mb-3 m-auto">
            <div class="col-sm-2">
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
                    <li>{{ $manga->synopsis }}</li>
                    <li> Fecha de Publicacion: {{ $manga->release_date }}</li>
                    <li>${{ $manga->price }}</li>
                </ul>
            </div>
        </div>
    </article>

    <form action="{{ route('admin.trashed.mangas.processTrashDeleteManga', ['id' => $manga->id]) }}" method="post">
        @csrf
        <h2 class="mb-3">Confirmación Necesaria</h2>
        <h2>¿Desea eliminar este Manga de forma permanente? Una vez eliminado no se puede revertir.</h2>

        <button type="submit" class="btn boton2">Eliminar permanentemente</button>
    </form>
@endsection
