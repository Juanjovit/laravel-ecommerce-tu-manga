<?php
/** @var \Illuminate\Support\ViewErrorBag $errors */
/** @var \App\Models\Serie[]|\Illuminate\Database\Eloquent\Collection $series */
?>

@extends('layout.navbar')
@section('title', 'Añadir una serie')

@section('main')

    <h1 class="titleColorBg">Añadir una Nueva Serie</h1>

    <div class="mb-3">
    <a href="{{ route('admin.series') }}">Volver</a>
</div>

    <form action="{{ route('admin.processNewSerie') }}" method="post" enctype="multipart/form-data" class="mx-5">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Título</label>
            <input
                type="text"
                id="title"
                name="title"
                class="form-control"
                @error('title') aria-describedby="error-title" @enderror
            >
            @error('title')
    
                <div class="ps-4 formAlertNotification" id="error-title">{{ $message }}</div>
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
