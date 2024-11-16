<?php
/** @var \App\Models\Manga[]|\Illuminate\Database\Eloquent\Collection $mangas */
?>


@extends('layout.navbar')
@section('title', 'Mangas Dashboard')

@section('main')


    <h1 class="titleColorBg">Panel de Administrador</h1>


    <div class="mb-3">
        <a href="{{ route('admin.dashboard') }}">Volver</a>
    </div>
    <div class="mb-3">
        <a href="{{ route('admin.formNew') }}">Añadir un manga</a>
    </div>
    <div class="mb-3">
        <a href="{{ route('admin.trashed.mangas.index') }}">Mangas Eliminados</a>
    </div>



    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Id</th>
                <th>Título</th>
                <th>Título en ingles</th>
                <th>Título en español</th>
                <th>Serie</th>
                <th>Sinopsis</th>
                <th>Precio</th>
                <th>Fecha de lanzamiento</th>
                <th>Tapa</th>
                <th>Descripcion de la imagen</th>

                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($mangas as $manga)
                <tr>
                    <td>{{ $manga->id }}</td>
                    <td>{{ $manga->title }}</td>
                    <td>{{ $manga->en_alternative_title }}</td>
                    <td>{{ $manga->es_alternative_title }}</td>
                    <td>{{ $manga->serie->title }}</td>
                    <td>{{ $manga->synopsis }}</td>
                    <td>$ {{ $manga->price }}</td>
                    <td>{{ $manga->release_date }}</td>
                    <td>
                        @if($manga->cover !== null && Storage::has('imgs/' . $manga->cover))
                            <img src="{{ Storage::url('imgs/' . $manga->cover) }}" alt="{{ $alt ?? $manga->cover_description }}" class="w-50">
                        @else
                            <img src="{{ Storage::url('imgs/' . 'imagenNoDisponible.jpg') }}" alt="imagen no disponible" class="w-50">
                        @endif
                    </td>
                    <td>{{ $manga->cover_description }}</td>
                    <td>
                        <a href="{{ route('mangas' , ['id' => $manga->id]) }}" class="btn boton1 m-1">Ver</a>
                        <a href="{{ route('admin.formUpdate', ['id' => $manga->id]) }}" class="btn boton1 m-1">Editar</a>
                        <a href="{{ route('admin.confirmDelete', ['id' => $manga->id]) }}" class="btn boton2 m-1">Eliminar</a>

                    </td>    
                


                </tr>
            @endforeach
        </tbody>
</table>




@endsection