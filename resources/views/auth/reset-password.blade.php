@extends('layouts.app')

@section('content')
    <div class="container mt-2 mb-2">
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
            <form method="post" action="{{route('change-password')}}" class="mb-3 md-6">
                @csrf
                <div class="mb-3">
                    <label for="password" class="form-label">Nueva Contraseña</label>
                    <input type="password" class="form-control" name="password">
                </div>
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Repite Contraseña</label>
                    <input type="password" class="form-control" name="password_confirmation">
                </div>
                <div class="d-flex justify-content-center mb-3">
                    <button type="submit" class="btn btn-primary">Cambiar</button>
                </div>
                <div class="d-flex justify-content-center">
                    <a class="btn btn-danger btn-md" href="{{ route('login') }}">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
@endsection
