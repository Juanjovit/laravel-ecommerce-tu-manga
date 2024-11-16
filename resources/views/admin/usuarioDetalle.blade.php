<?php
/** @var \App\Models\User[]|\Illuminate\Database\Eloquent\Collection $usuario */
?>


@extends('layout.navbar')
@section('title', 'Usuario $usuario->email')

@section('main')


    <h1 class="titleColorBg">Detalles de Usuario</h1>


    <div class="mb-3">
        <a href="{{ route('admin.usuarios') }}">Volver</a>
    </div>

    <h2>Detalles</h2>
    <table class="table table-bordered table-striped mb-5">
        <thead>
            <tr>
                <th>Id</th>
                <th>Email</th>
                <th>Rol de usuario</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $usuario->user_id }}</td>
                <td>{{ $usuario->email }}</td>
                @if($usuario->user_role === 0)
                    <td>Administrador</td>
                @elseif($usuario->user_role === 1)
                    <td>Usuario</td>
                @endif
            </tr>
        </tbody>
    </table>

    <h2>Compras</h2>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Id</th>
                <th>Precio total</th>
                <th>Fecha de la compra</th>
                <th>Mangas comprados</th>
            </tr>
        </thead>
        <tbody>

        @foreach($compras as $compra)
            <tr>
                <td>{{ $compra->id }}</td>
                <td>${{ $compra->total_price }} </td>
                <td>{{ $compra->purchase_date }} </td>
                <td>
                    <ul>
                        @foreach($compra->mangas as $manga)
                            <li>{{ $manga->title }} ${{ $manga->price }}</li>
                        @endforeach
                    </ul>
                </td>
            </tr>
        @endforeach
        </tbody>

</table>




@endsection