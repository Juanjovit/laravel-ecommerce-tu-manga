<?php
/** @var \Illuminate\Support\ViewErrorBag $errors */
/** @var \App\Models\Serie[]|\Illuminate\Database\Eloquent\Collection $series */
/** @var \App\Models\Manga $manga */
?>


@extends('layout.navbar')

@section('title', 'Editar Manga ' . $manga->title)

@section('main')
    <h1 class="titleColorBg">Editar '{{ $manga->title}}'</h1>

<div class="mb-3">
    <a href="{{ route('admin.mangas') }}">Volver</a>
</div>    

    <form action="{{ route('admin.processUpdate', ['id' => $manga->id]) }}" method="post" enctype="multipart/form-data" class="mx-5">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Título</label>
            <input
                type="text"
                id="title"
                name="title"
                class="form-control"
                @if($errors->has('title')) aria-describedby="error-title" @endif
                value="{{ old('title', $manga->title) }}"
            >
            @if($errors->has('title'))
                <div class="ps-4 formAlertNotification" id="error-title">{{ $errors->first('title') }}</div>
            @endif
        </div>
        <div class="mb-3">
            <label for="title" class="form-label">Título alternativo en ingles</label>
            <input
                type="text"
                id="en_alternative_title"
                name="en_alternative_title"
                class="form-control"
                @if($errors->has('en_alternative_title')) aria-describedby="error-title" @endif
                value="{{ old('en_alternative_title', $manga->en_alternative_title) }}"
            >
            @if($errors->has('en_alternative_title'))
                <div class="ps-4 formAlertNotification" id="error-en_alternative_title">{{ $errors->first('en_alternative_title') }}</div>
            @endif
        </div>
        <div class="mb-3">
            <label for="title" class="form-label">Título alternativo en español</label>
            <input
                type="text"
                id="es_alternative_title"
                name="es_alternative_title"
                class="form-control"
                @if($errors->has('es_alternative_title')) aria-describedby="error-title" @endif
                value="{{ old('es_alternative_title', $manga->es_alternative_title) }}"
            >
            @if($errors->has('es_alternative_title'))
                <div class="ps-4 formAlertNotification" id="error-es_alternative_title">{{ $errors->first('es_alternative_title') }}</div>
            @endif
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
                        @selected(old('serie_fk', $manga->serie_fk) == $serie->id)
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
            >{{ old('synopsis', $manga->synopsis) }}</textarea>
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
                value="{{ old('price', $manga->price) }}"
            >
            @error('price')
                <div class="ps-4 formAlertNotification" id="error-price">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="release_date" class="form-label">Fecha de Publicacion</label>
            <input
                type="date"
                id="release_date"
                name="release_date"
                class="form-control"
                @error('release_date') aria-describedby="error-release_date" @enderror
                value="{{ old('release_date', $manga->release_date) }}"
                
            >
            @error('release_date')
                <div class="ps-4 formAlertNotification" id="error-release_date">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <p>Tapa Actual</p>
                @if($manga->cover !== null && Storage::has('imgs/' . $manga->cover))
                    <img src="{{ Storage::url('imgs/' . $manga->cover) }}" alt="{{ $alt ?? $manga->cover_description }}" class="w-25">
                @else
                    <img src="{{ Storage::url('imgs/' . 'imagenNoDisponible.jpg') }}" alt="imagen no disponible" class="w-25">
                @endif     
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
                value="{{ old('cover_description', $manga->cover_description) }}"
            >
            @error('cover_description')
                <div class="ps-4 formAlertNotification" id="error-cover_description">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn boton1">Publicar</button>
    </form>
@endsection
