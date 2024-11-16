<?php
/** @var \App\Models\Serie[]|\Illuminate\Database\Eloquent\Collection $serie */
?>


@extends('layout.navbar')
@section('title', 'Ver por Serie')

@section('main')

    <h1 class="titleColorBg">Ver por Serie</h1>    
    <div class="row m-auto">
        @foreach($mangas as $manga)
            <div class="col">
                <x-manga-card :manga="$manga" />
            </div>
        @endforeach
    </div>

@endsection