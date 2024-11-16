<?php
/** @var \App\Models\Manga[]|\Illuminate\Database\Eloquent\Collection $mangas */
?>

@extends('layout.navbar')
@section('title', 'Mangas Eliminados')

@section('main')
    <h1 class="titleColorBg">Mangas Eliminados</h1>

    <div class="mb-3">
        <a href="{{ route('admin.mangas') }}">Volver</a>
    </div>

    @if($mangas->isEmpty())
        <p>
            No hay mangas eliminados.
        </p>
    @else
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Título</th>
                    <th>Título en inglés</th>
                    <th>Título en español</th>
                    <th>Sinopsis</th>
                    <th>Precio</th>
                    <th>Fecha de lanzamiento</th>
                    <th>Tapa</th>
                    <th>Descripción de la imagen</th>
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
                        <td>{{ $manga->synopsis }}</td>
                        <td>$ {{ $manga->price }}</td>
                        <td>{{ $manga->release_date }}</td>
                        <td>
                            @if($manga->cover !== null && Storage::has('imgs/' . $manga->cover))
                                <img src="{{ Storage::url('imgs/' . $manga->cover) }}" alt="{{ $alt ?? $manga->cover_description }}" class="w-25">
                            @else
                                <img src="{{ Storage::url('imgs/' . 'imagenNoDisponible.jpg') }}" alt="imagen no disponible" class="w-25">
                            @endif
                        </td>
                        <td>{{ $manga->cover_description }}</td>
                        <td>
                            <a href="{{ route('admin.trashed.mangas.confirmTrashDeleteManga', ['id' => $manga->id]) }}" class="btn boton2">Eliminar</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
