@extends('layouts.app')

@section('content')
    <div class="container d-flex justify-content-center mt-2 mb-2">
        <div class="row">
            <form method="post" action="{{ route('register-user') }}" class="mb-3">
                @if (session('error'))
                    <x-alert color="danger">
                        {{ session('error') }}
                    </x-alert>
                @endif
                @csrf
                <div class="row">
                    <div class="mb-3 col-md-6 col-sm-12">
                        <label for="name" class="form-label">Nombre</label>
                        <input type="email" class="form-control" name="name">
                        <x-validation field="name" />
                    </div>
                    <div class="mb-3 col-md-6 col-sm-12">
                        <label for="lastname" class="form-label">Apellido</label>
                        <input type="password" class="form-control" name="lastname">
                        <x-validation field="lastname" />
                    </div>
                    <div class="mb-3 col-md-6 col-sm-12">
                        <label for="identification" class="form-label">Identificacion</label>
                        <input type="number" class="form-control" name="identification" min="3">
                        <x-validation field="identification" />
                    </div>
                    <div class="mb-3 col-md-6 col-sm-12">
                        <label for="email" class="form-label">Correo electronico</label>
                        <input type="email" class="form-control" name="email">
                        <x-validation field="email" />
                    </div>
                    <div class="mb-3 col-md-12">
                        <label for="birthday" class="form-label">Fecha Nacimiento</label>
                        <input type="date" class="form-control" name="birthday">
                        <x-validation field="birthday" />
                    </div>
                    <div class="mb-3 col-md-6 col-sm-12">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" name="password">
                        <x-validation field="password" />
                    </div>
                    <div class="mb-3 col-md-6 col-sm-12">
                        <label for="password_confirmation" class="form-label">Repetir Contraseña</label>
                        <input type="password" class="form-control" name="password_confirmation">
                        <x-validation field="password_confirmation" />
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary">Registro</button>
                </div>
            </form>
            <div class="d-flex justify-content-center">
                <a href="{{ route('login') }}">Iniciar Sesion</a>
            </div>
            <div class="d-flex justify-content-center">
                <a href="{{ route('verify-user') }}">Olvidasta tu contraseña?</a>
            </div>
        </div>
    </div>
@endsection
