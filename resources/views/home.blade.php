<?php
/** @var \App\Models\Manga[]|\Illuminate\Database\Eloquent\Collection $mangas */
/** @var \App\Models\News[]|\Illuminate\Database\Eloquent\Collection $noticias */
?>

@extends('layout.navbar')
@section('title', 'Home')

@section('main')
    <h1 class="titleColorBg">Home</h1>

    <h2 class="titleColorBg">Noticias</h2>
    <div class="row">
        @foreach($noticias as $noticia)
            <div class="col-12 col-md-5 m-auto card customCardNoticia d-flex ">
  
                <a href="{{ route('noticiaById' , ['id' => $noticia->id]) }}">
                    @if($noticia->image !== null && Storage::has('imgs/' . $noticia->image))
                        <img src="{{ Storage::url('imgs/' . $noticia->image) }}" alt="{{ $alt ?? $noticia->image_description }}" class="w-100">
                    @else
                        <img src="{{ Storage::url('imgs/' . 'imagenNoDisponible2.jpg') }}" alt="imagen no disponible" class="w-100">
                    @endif        
                    <div class="card-body">
                        <h3 class="card-title">{{$noticia->title}}</h3>
                        <p class="card-text">{{$noticia->resume}}</p>
                        <p class="card-text date-text">{{$noticia->created_at}}</p>
                    </div>
                </a>
            </div>
        @endforeach
    </div>

    <h2 class="titleColorBg">Mangas</h2>
    <div class="row m-auto">
        @foreach($mangas as $manga)
            <div class="col">
                <x-manga-card :manga="$manga" />
            </div>
        @endforeach
    </div>
@endsection