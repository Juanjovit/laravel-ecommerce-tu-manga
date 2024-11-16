<?php
/** @var \App\Models\News[]|\Illuminate\Database\Eloquent\Collection $noticias */
?>

@extends('layout.navbar')
@section('title', 'Noticias Eliminadas')

@section('main')
    <h1 class="titleColorBg">Noticias Eliminadas</h1>

    <div class="mb-3">
        <a href="{{ route('admin.noticias') }}">Volver</a>
    </div>

    @if($noticias->isEmpty())
        <div>
            No hay noticias eliminadas.
        </div>
    @else
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Título</th>
                    <th>Fecha de publicación</th>
                    <th>Tapa</th>
                    <th>Descripción de la imagen</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($noticias as $noticia)
                    <tr>
                        <td>{{ $noticia->id }}</td>
                        <td>{{ $noticia->title }}</td>
                        <td>{{ $noticia->created_at }}</td>
                        <td>
                            @if($noticia->image !== null && Storage::has('imgs/' . $noticia->image))
                                <img src="{{ Storage::url('imgs/' . $noticia->image) }}" alt="{{ $alt ?? $noticia->image_description }}" class="w-50">
                            @else
                                <img src="{{ Storage::url('imgs/' . 'imagenNoDisponible2.jpg') }}" alt="imagen no disponible" class="w-50">
                            @endif
                        </td>
                        <td>{{ $noticia->image_description }}</td>
                        <td>
                            <a href="{{ route('admin.trashed.noticias.confirmTrashDeleteNoticia', ['id' => $noticia->id]) }}" class="btn boton2">Eliminar</a>
                        </td>    
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
