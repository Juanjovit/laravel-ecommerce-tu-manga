<?php
/** @var \App\Models\Serie[]|\Illuminate\Database\Eloquent\Collection $serie */
?>


@extends('layout.navbar')
@section('title', 'Ver por Serie')

@section('main')

    <h1 class="titleColorBg">Ver por Serie</h1>

    <div class="row m-auto">
        @foreach($series as $serie)
            <div class="col">
                <article class="card customCard mb-3 d-flex ">
                    <div class="card d-flex">
                        <a href="{{ route('serieById' , ['id' => $serie->id]) }}">
                            @if($serie->image !== null && Storage::has('imgs/' . $serie->image))
                                <img src="{{ Storage::url('imgs/' . $serie->image) }}" alt="{{ $alt ?? $serie->image_description }}" class="w-100">
                            @else
                                <img src="{{ Storage::url('imgs/' . 'imagenNoDisponible.jpg') }}" alt="imagen no disponible" class="w-100">
                            @endif        
                            <div class="card-body">
                                <h2 class="card-title">{{ $serie->title }}</h2>
                            </div>
                        </a>
                    </div>
                </article>
            </div>
        @endforeach
    </div>






@endsection