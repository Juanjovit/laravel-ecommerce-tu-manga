<?php
/** @var \App\Models\Manga[]|\Illuminate\Database\Eloquent\Collection $mangas */
?>


@extends('layout.navbar')
@section('title', 'Shop')

@section('main')

    <h1 class="titleColorBg">Shop</h1>
    <div class="row m-auto">
        @foreach($mangas as $manga)
            <div class="col">
                <x-manga-card :manga="$manga" />
            </div>
        @endforeach
    </div>

@endsection