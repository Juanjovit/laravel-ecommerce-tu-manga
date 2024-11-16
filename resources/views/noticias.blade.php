<?php
/** @var \App\Models\News[]|\Illuminate\Database\Eloquent\Collection $noticias */
?>


@extends('layout.navbar')
@section('title', 'Noticias')

@section('main')

    <h1 class="titleColorBg">Noticias</h1>
    <div class="row m-auto">
        @foreach($noticias as $noticia)

            <div class="col-12 m-auto me-5 card customCardNoticia d-flex ">
                <?php
                ?>
                <a href="{{ route('noticiaById' , ['id' => $noticia->id]) }}">

                    <div class="row">
                        <div class="col-sm-4">
                             @if($noticia->image !== null && Storage::has('imgs/' . $noticia->image))
                                <img src="{{ Storage::url('imgs/' . $noticia->image) }}" alt="{{ $alt ?? $noticia->image_description }}" class="w-100">
                            @else
                                <img src="{{ Storage::url('imgs/' . 'imagenNoDisponible2.jpg') }}" alt="imagen no disponible" class="w-100">
                            @endif        
                        </div>
                        <div class="col noticiaCardText">
                            <h2 class="card-title">{{$noticia->title}}</h2>
                            <p class="card-text">{{$noticia->resume}}</p>
                            <p class="card-text">{{$noticia->article}}</p>
                            <p class="card-text date-text">{{$noticia->created_at}}</p>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>

@endsection