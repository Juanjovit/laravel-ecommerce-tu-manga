<?php
/** @var \App\Models\Serie[]|\Illuminate\Database\Eloquent\Collection $series */
?>


@extends('layout.navbar')
@section('title', 'Series Dashboard')

@section('main')


    <h1 class="titleColorBg">Panel de Series</h1>


    <div class="mb-3">
        <a href="{{ route('admin.dashboard') }}">Volver</a>
    </div>
    <div class="mb-3">
        <a href="{{ route('admin.formNewSerie') }}">Añadir una serie</a>
    </div>




    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Id</th>
                <th>Título</th>
                <th>Tapa</th>
                <th>Descripcion de la imagen</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($series as $serie)
                <tr>
                    <td>{{ $serie->id }}</td>
                    <td>{{ $serie->title }}</td>
                    <td>
                        @if($serie->image !== null && Storage::has('imgs/' . $serie->image))
                            <img src="{{ Storage::url('imgs/' . $serie->image) }}" alt="{{ $alt ?? $serie->image_description }}" class="w-25">
                        @else
                            <img src="{{ Storage::url('imgs/' . 'imagenNoDisponible.jpg') }}" alt="imagen no disponible" class="w-25">
                        @endif
                    </td>
                    <td>{{ $serie->image_description }}</td>
                    <td>
                        <a href="{{ route('admin.formUpdateSerie', ['id' => $serie->id]) }}" class="btn boton1 m-1">Editar</a>
                        <a href="{{ route('admin.confirmDeleteSerie', ['id' => $serie->id]) }}" class="btn boton2 m-1">Eliminar</a>
                    </td>    
                </tr>
            @endforeach
        </tbody>
</table>




@endsection