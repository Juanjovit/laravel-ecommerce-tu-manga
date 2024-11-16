<?php
/** @var \Illuminate\Support\ViewErrorBag $errors */
?>

@extends('layout.navbar')

@section('title', 'Registrarse')

@section('main')

<h1 class="mb-3 titleColorBg">Registrarse</h1>
<h2 class="text-center">¡Ingresa tus datos para registrarte en TuManga!</h2>
<div class="mx-5 px-5">
    <form action="{{ route('auth.processRegister') }}" method="post" class="text-start">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}"
            @error('email') aria-describedby="error-email" @enderror
            >
            @error('email')    
                <div class="ps-4 formAlertNotification" id="error-email">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
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
        <button type="submit" class="btn boton1 w-100">Registrarse</button>
    </form>

    <p class="text-center mt-5">Ya estas registrado?<a class="nav-link customLink" href="{{ route('auth.formLogin') }}">Inicia sesión!</a></p>
</div>


@endsection
