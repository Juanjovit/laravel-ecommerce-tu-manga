<?php
/** @var \Illuminate\Support\ViewErrorBag $errors */
?>

@extends('layout.navbar')
@section('title', 'Añadir una noticia')

@section('main')

    <h1 class="titleColorBg">Añadir una Nueva Noticia</h1>

    <div class="mb-3">
    <a href="{{ route('admin.noticias') }}">Volver</a>
</div>

    <form action="{{ route('admin.processNewNoticia') }}" method="post" enctype="multipart/form-data" class="mx-5">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Título</label>
            <input
                type="text"
                id="title"
                name="title"
                class="form-control"
                @error('title') aria-describedby="error-title" @enderror
                value="{{ old('title') }}"
            >
            @error('title')
    
                <div class="ps-4 formAlertNotification" id="error-title">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="resume" class="form-label">Resumen</label>
            <textarea
                id="resume"
                name="resume"
                class="form-control"
                @error('resume') aria-describedby="error-resume" @enderror
            >{{ old('resume') }}</textarea>
            @error('resume')
                <div class="ps-4 formAlertNotification" id="error-resume">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="article" class="form-label">Articulo</label>
            <textarea
                id="article"
                name="article"
                class="form-control"
                @error('article') aria-describedby="error-article" @enderror
            >{{ old('article') }}</textarea>
            @error('article')
                <div class="ps-4 formAlertNotification" id="error-article">{{ $message }}</div>
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
                value="{{ old('image_description') }}"
            >
            @error('image_description')

                <div class="ps-4 formAlertNotification" id="error-image_description">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn boton1">Publicar</button>
    </form>
@endsection
