<?php
/** @var \App\Models\User[]|\Illuminate\Database\Eloquent\Collection $usuario */
/** @var \Illuminate\Support\ViewErrorBag $errors */
?>

@extends('layout.navbar')
@section('title', 'Editar Password')

@section('main')
    <h1 class="titleColorBg">Editar Password</h1>


    <form action="{{ route('processEditarPassword', ['id' => $usuario->user_id]) }}" method="post" enctype="multipart/form-data" class="mx-5">
    @csrf
        <div class="mb-3">
            <label for="password" class="form-label">Nuevo Password</label>
            <input type="password" name="password" id="password" class="form-control"
            @error('password') aria-describedby="error-password" @enderror
            >
            @error('password')    
                <div class="ps-4 formAlertNotification" id="error-password">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="confirmPassword" class="form-label">Repetir Password</label>
            <input type="password" name="confirmPassword" id="confirmPassword" class="form-control"
            @error('confirmPassword') aria-describedby="error-confirmPassword" @enderror
            >
            @error('confirmPassword')    
                <div class="ps-4 formAlertNotification" id="error-confirmPassword">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn boton1 w-100">Confirmar</button>
    </form>

@endsection