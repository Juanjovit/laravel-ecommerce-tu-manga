@extends('layout.navbar')

@section('title', 'Iniciar Sesión')

@section('main')

<h1 class="mb-3 titleColorBg">Iniciar Sesión</h1>
<h2 class="text-center">¡Ingresa tus datos para iniciar sesion en TuManga!</h2>
<div class="mx-5 px-5">
    <form action="{{ route('auth.processLogin') }}" method="post" class="text-start">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" id="password" class="form-control">
        </div>
        <button type="submit" class="btn boton1 w-100">Iniciar sesión</button>
    </form>

    <p class="text-center mt-5">Ya estas registrado?<a class="nav-link customLink" href="{{ route('auth.formRegister') }}">Registrate!</a></p>
</div>

@endsection
