@extends('layouts.app')

@section('content')
    <div class="container d-flex justify-content-center mt-2 mb-2">

        <div class="row">
            @if (session('error'))
                <x-alert color="danger">
                    {{ session('error') }}
                </x-alert>
            @endif
            <form method="post" action="{{route('verify-user-information')}}" class="mb-3">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Correo Electronico</label>
                    <input type="email" class="form-control" name="email" aria-describedby="emailHelp" required>
                </div>
                <div class="mb-3">
                    <label for="identification" class="form-label">Identificacion</label>
                    <input type="number" class="form-control" name="identification" required min="3">
                </div>
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary">Verificar</button>
                </div>
            </form>
            <div class="d-flex justify-content-center">
                <a href="{{ route('register') }}">Registrarse</a>
            </div>
            <div class="d-flex justify-content-center">
                <a href="{{ route('login') }}">Iniciar Sesion</a>
            </div>
        </div>
    </div>
@endsection
