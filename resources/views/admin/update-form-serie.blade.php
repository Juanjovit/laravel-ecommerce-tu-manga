<?php
/** @var \Illuminate\Support\ViewErrorBag $errors */
/** @var \App\Models\Serie $serie */
?>


@extends('layout.navbar')

@section('title', 'Editar Serie ' . $serie->title)

@section('main')
    <h1 class="titleColorBg">Editar '{{$serie->title}}'</h1>

<div class="mb-3">
    <a href="{{ route('admin.series') }}">Volver</a>
</div>    

    <form action="{{ route('admin.processUpdateSerie', ['id' => $serie->id]) }}" method="post" enctype="multipart/form-data" class="mx-5">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Título</label>
            <input
                type="text"
                id="title"
                name="title"
                class="form-control"
                @if($errors->has('title')) aria-describedby="error-title" @endif
                value="{{ old('title', $serie->title) }}"
            >
            @if($errors->has('title'))
                <div class="ps-4 formAlertNotification" id="error-title">{{ $errors->first('title') }}</div>
            @endif
        </div>
        <div class="mb-3">
            <p>Imagen Actual</p>
                @if($serie->image !== null && Storage::has('imgs/' . $serie->image))
                    <img src="{{ Storage::url('imgs/' . $serie->image) }}" alt="{{ $alt ?? $serie->image_description }}" class="w-25">
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
                value="{{ old('image_description', $serie->image_description) }}"
            >
            @error('image_description')
                <div class="ps-4 formAlertNotification" id="error-image_description">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn boton1">Publicar</button>
    </form>
@endsection
