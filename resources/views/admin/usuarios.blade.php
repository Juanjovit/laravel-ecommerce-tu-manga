<?php
/** @var \App\Models\User[]|\Illuminate\Database\Eloquent\Collection $usuarios */
?>


@extends('layout.navbar')
@section('title', 'Usuarios Dashboard')

@section('main')


    <h1 class="titleColorBg">Panel de Usuarios</h1>


    <div class="mb-3">
        <a href="{{ route('admin.dashboard') }}">Volver</a>
    </div>




    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Id</th>
                <th>Email</th>
                <th>Rol de usuario</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($usuarios as $usuario)
                <tr>
                    <td>{{ $usuario->user_id }}</td>
                    <td>{{ $usuario->email }} </td>
                    @if($usuario->user_role === 0)
                        <td>Administrador</td>
                    @elseif($usuario->user_role === 1)
                        <td>Usuario</td>
                    @endif
                    <td><a href="{{ route('admin.usuarioDetalle' , ['id' => $usuario->user_id]) }}" class="btn boton1 m-1">Ver</a></td>
                </tr>
            @endforeach
        </tbody>
</table>




@endsection