<?php
/** @var \App\Models\Manga[]|\Illuminate\Database\Eloquent\Collection $mangas */
?>


@extends('layout.navbar')
@section('title', 'Admin Dashboard')

@section('main')

    <h1 class="titleColorBg mb-4">Panel de Administrador</h1>

    <div class="mb-3">
        <a href="{{ route('admin.mangas') }}">Mangas</a>
    </div>
    <div class="mb-3">
        <a href="{{ route('admin.series') }}">Series</a>
    </div>
    <div class="mb-3">
        <a href="{{ route('admin.noticias') }}">Noticias</a>
    </div>
    <div class="mb-5">
        <a href="{{ route('admin.usuarios') }}">Usuarios</a>
    </div>

    <h2 class="titleColorBg">Productos mas vendidos</h2>

    <div class="row m-auto">
        @php 
            $contador = 0; 
        @endphp
        @foreach($mangaMasVendido as $manga)
            @if ($contador < 3)
                <div class="col">
                <h3 class="topVentas text-center">Top {{ $contador+1 }} - Ventas: {{ $manga['total_quantity'] }}</h3>

                    <div class="card customCard d-flex">
                    <div class="card  d-flex">
                        <a href="{{ route('mangas' , ['id' =>  $manga['id']]) }}">
                            @if($manga['cover'] !== null && Storage::has('imgs/' . $manga['cover']))
                                <img src="{{ Storage::url('imgs/' . $manga['cover']) }}" alt="{{ $alt ?? $manga['cover'] }}" class="w-100">
                            @else
                                <img src="{{ Storage::url('imgs/' . 'imagenNoDisponible2.jpg') }}" alt="imagen no disponible"  class="w-100">
                            @endif        
                            <div class="card-body">
                                <h3 class="card-title">{{ $manga['title'] }}</h3>
                            </div>
                        </a>
                    </div>
                    </div>
                        @php 
                            $contador++; 
                        @endphp
                </div>
            @endif
        @endforeach    
    </div>

@endsection