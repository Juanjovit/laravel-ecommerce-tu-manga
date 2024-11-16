<?php
/** @var \App\Models\News $noticia */
?>

@extends('layout.navbar')

@section('title', $noticia->title)

@section('main')
    <article>
        <div class="row mb-3 mt-1 px-5 m-auto">
            <div class="col">
                @if($noticia->image !== null && Storage::has('imgs/' . $noticia->image))
                    <img src="{{ Storage::url('imgs/' . $noticia->image) }}" alt="{{ $alt ?? $noticia->image_description }}" class="w-100">
                @else
                    <img src="{{ Storage::url('imgs/' . 'imagenNoDisponible2.jpg') }}" alt="imagen no disponible" class="w-100">
                @endif     
            </div>
            <div class="col-md-7">
                <h1 class="mb-3 titleColorBg">{{ $noticia->title }}</h1>
                <p class="mb-3">{{ $noticia->resume }}</p>
                <p class="mb-3 date-text">{{ $noticia->created_at }}</p>

            </div>
            <p class="mb-3">{{ $noticia->article }}</p>

        </div>

    </article>
@endsection
