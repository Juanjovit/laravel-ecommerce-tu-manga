<?php
/** @var \App\Models\News[]|\Illuminate\Database\Eloquent\Collection $noticias */
?>


@extends('layout.navbar')
@section('title', 'Noticias Dashboard')

@section('main')


    <h1 class="titleColorBg">Panel de Noticias</h1>


    <div class="mb-3">
        <a href="{{ route('admin.dashboard') }}">Volver</a>
    </div>
    <div class="mb-3">
        <a href="{{ route('admin.formNewNoticia') }}">Añadir una noticia</a>
    </div>
    <div class="mb-3">
        <a href="{{ route('admin.trashed.noticias.index') }}">Noticias Eliminadas</a>
    </div>



    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Id</th>
                <th>Título</th>
                <th>Fecha de publicación</th>
                <th>Imagen</th>
                <th>Descripcion de la imagen</th>
                <th>Fecha de publicación</th>
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
                    <td>{{ $noticia->release_date }}</td>
                    <td>
                        <a href="{{ route('noticiaById' , ['id' => $noticia->id]) }}" class="btn boton1 m-1">Ver</a>
                        <a href="{{ route('admin.formUpdateNoticia', ['id' => $noticia->id]) }}" class="btn boton1 m-1">Editar</a>
                        <a href="{{ route('admin.confirmDeleteNoticia', ['id' => $noticia->id]) }}" class="btn boton2 m-1">Eliminar</a>
                    </td>    
                </tr>
            @endforeach
        </tbody>
</table>




@endsection