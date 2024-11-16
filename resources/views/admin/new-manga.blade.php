<?php
/** @var \Illuminate\Support\ViewErrorBag $errors */
/** @var \App\Models\Serie[]|\Illuminate\Database\Eloquent\Collection $series */
?>

@extends('layout.navbar')
@section('title', 'Añadir un manga')

@section('main')

    <h1 class="titleColorBg">Añadir un Nuevo Manga</h1>

    <div class="mb-3">
    <a href="{{ route('admin.mangas') }}">Volver</a>
</div>

    <form action="{{ route('admin.processNew') }}" method="post" enctype="multipart/form-data" class="mx-5">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Título</label>
            <input
                type="text"
                id="title"
                name="title"
                class="form-control"
                value="{{ old('title') }}"
                @error('title') aria-describedby="error-title" @enderror
            >

            @error('title')
    
                <div class="ps-4 formAlertNotification" id="error-title">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="en_alternative_title" class="form-label">Título alternativo en ingles</label>
            <input
                type="text"
                id="en_alternative_title"
                name="en_alternative_title"
                class="form-control"
                value="{{ old('en_alternative_title') }}"
                @error('en_alternative_title') aria-describedby="error-en_alternative_title" @enderror
            >
            @error('en_alternative_title')
    
                <div class="ps-4 formAlertNotification" id="error-en_alternative_title">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="es_alternative_title" class="form-label">Título alternativo en español</label>
            <input
                type="text"
                id="es_alternative_title"
                name="es_alternative_title"
                class="form-control"
                value="{{ old('es_alternative_title') }}"
                @error('es_alternative_title') aria-describedby="error-es_alternative_title" @enderror
            >
            @error('es_alternative_title')
    
                <div class="ps-4 formAlertNotification" id="error-es_alternative_title">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="serie_fk" class="form-label">Serie</label>
            <select
                name="serie_fk"
                id="serie_fk"
                class="form-control"
                @error('serie_fk') aria-describedby="error-serie_fk" @enderror
            >
                <option value="">-Selecciona una serie-</option>
                @foreach($series as $serie)
                    <option
                        value="{{ $serie->id }}"
                        @selected(old('serie_fk') == $serie->id)
                    >{{ $serie->title }}</option>
                @endforeach
            </select>
            @error('serie_fk')
                <div class="ps-4 formAlertNotification" id="error-serie_fk">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="synopsis" class="form-label">Sinopsis</label>
            <textarea
                id="synopsis"
                name="synopsis"
                class="form-control"
                @error('synopsis') aria-describedby="error-synopsis" @enderror
            >{{ old('synopsis') }}</textarea>
            @error('synopsis')

                <div class="ps-4 formAlertNotification" id="error-synopsis">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Precio</label>
            <input
                type="text"
                id="price"
                name="price"
                class="form-control"
                @error('price') aria-describedby="error-price" @enderror
                value="{{ old('price') }}"
            >
            @error('price')

                <div class="ps-4 formAlertNotification" id="error-price">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="release_date" class="form-label">Fecha de Publicación</label>
            <input
                type="date"
                id="release_date"
                name="release_date"
                class="form-control"
                @error('release_date') aria-describedby="error-release_date" @enderror
                value="{{ old('release_date') }}"
            >
            @error('release_date')
    
                <div class="ps-4 formAlertNotification" id="error-release_date">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="cover" class="form-label">Tapa</label>
            <input
                type="file"
                id="cover"
                name="cover"
                class="form-control"
                @error('cover') aria-describedby="error-cover" @enderror
            >
            @error('cover')

                <div class="ps-4 formAlertNotification" id="error-cover">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="cover_description" class="form-label">Descripción de la Tapa</label>
            <input
                type="text"
                id="cover_description"
                name="cover_description"
                class="form-control"
                @error('cover_description') aria-describedby="error-cover_description" @enderror
                value="{{ old('cover_description') }}"
            >
            @error('cover_description')

                <div class="ps-4 formAlertNotification" id="error-cover_description">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn boton1">Publicar</button>
    </form>
@endsection
