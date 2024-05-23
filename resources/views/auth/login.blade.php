@extends('layouts.app')

@section('content')
    <div class="container d-flex justify-content-center mt-2 mb-2">
        <div class="row">
            @if (session('error'))
                <x-alert color="danger">
                    {{ session('error') }}
                </x-alert>
            @endif

            @if (session('success'))
                <x-alert color="success">
                    {{ session('success') }}
                </x-alert>
            @endif
            <form method="post" action="{{route('login-user')}}" class="mb-3">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Correo Electronico</label>
                    <input type="email" class="form-control" name="email" aria-describedby="emailHelp"
                        value="{{old('email') ? old('email') : ''}}">
                    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    <x-validation field="email" />
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" name="password">
                    <x-validation field="password" />
                </div>
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary">Iniciar</button>
                </div>
            </form>
            <div class="d-flex justify-content-center">
                <a href="{{ route('register') }}">Registrarse</a>
            </div>
            <div class="d-flex justify-content-center">
                <a href="{{ route('verify-user') }}">Olvidasta tu contraseña?</a>
            </div>
        </div>
    </div>
@endsection
