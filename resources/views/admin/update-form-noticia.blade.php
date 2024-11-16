<?php
/** @var \Illuminate\Support\ViewErrorBag $errors */
/** @var \App\Models\News $noticia */
?>


@extends('layout.navbar')

@section('title', 'Editar Noticia ' . $noticia->title)

@section('main')
    <h1 class="titleColorBg">Editar '{{ $noticia->title}}'</h1>

<div class="mb-3">
    <a href="{{ route('admin.noticias') }}">Volver</a>
</div>    

    <form action="{{ route('admin.processUpdateNoticia', ['id' => $noticia->id]) }}" method="post" enctype="multipart/form-data" class="mx-5">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Título</label>
            <input
                type="text"
                id="title"
                name="title"
                class="form-control"
                @if($errors->has('title')) aria-describedby="error-title" @endif
                value="{{ old('title', $noticia->title) }}"
            >
            @if($errors->has('title'))
                <div class="ps-4 formAlertNotification" id="error-title">{{ $errors->first('title') }}</div>
            @endif
        </div>
        <div class="mb-3">
            <label for="resume" class="form-label">Resumen</label>
            <textarea
                id="resume"
                name="resume"
                class="form-control"
                @if($errors->has('resume')) aria-describedby="error-title" @endif
            >{{ old('resume', $noticia->resume) }}</textarea>
            @if($errors->has('resume'))
                <div class="ps-4 formAlertNotification" id="error-resume">{{ $errors->first('resume') }}</div>
            @endif
        </div>
        <div class="mb-3">
            <label for="article" class="form-label">Articulo</label>
            <textarea
                id="article"
                name="article"
                class="form-control"
                @error('article') aria-describedby="error-article" @enderror
            >{{ old('article', $noticia->article) }}</textarea>
            @error('article')
                <div class="ps-4 formAlertNotification" id="error-article">{{ $message }}</div>
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
                value="{{ old('release_date', $noticia->release_date) }}"
            >
            @error('release_date')
                <div class="ps-4 formAlertNotification" id="error-release_date">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <p>Imagen Actual</p>
                @if($noticia->image !== null && Storage::has('imgs/' . $noticia->image))
                    <img src="{{ Storage::url('imgs/' . $noticia->image) }}" alt="{{ $alt ?? $noticia->image_description }}" class="w-25">
                @else
                    <img src="{{ Storage::url('imgs/' . 'imagenNoDisponible2.jpg') }}" alt="imagen no disponible" class="w-25">
                @endif    
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Imagen</label>
            <input
                type="file"
                id="image"
                name="image"
                class="form-control"
                @error('image') aria-describedby="error-image" @enderror
            >
            @error('image')
                <div class="ps-4 formAlertNotification" id="error-image">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="image_description" class="form-label">Descripción de la Imagen</label>
            <input
                type="text"
                id="image_description"
                name="image_description"
                class="form-control"
                @error('image_description') aria-describedby="error-image_description" @enderror
                value="{{ old('image_description', $noticia->image_description) }}"
            >
            @error('image_description')
                <div class="ps-4 formAlertNotification" id="error-image_description">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn boton1">Publicar</button>
    </form>
@endsection
