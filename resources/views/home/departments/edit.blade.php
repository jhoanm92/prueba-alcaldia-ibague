@extends('layouts.app')

@section('content')
    <div class="container d-flex justify-content-center mt-2 mb-2">
        <div class="row">

            <div class="container">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <h1>
                            Editar departamento
                        </h1>
                    </div>
                </div>
            </div>

            @if (session('error'))
                <x-alert color="error">
                    {{ session('error') }}
                </x-alert>
            @endif

            <form method="post" action="{{ route('update-department', ['id' => $department->id]) }}" class="mb-3">
                @csrf
                @method('put')
                <div class="row">
                    <div class="mb-3 col-md-6 col-sm-12">
                        <label for="name" class="form-label">Nombre</label>
                        <input type="text" class="form-control" name="name" value="{{ $department->name }}">
                        <x-validation field="name" />
                    </div>
                    <div class="mb-3 col-md-6 col-sm-12">
                        <label for="lastname" class="form-label">Estado</label>
                        {{-- select --}}
                        <select name="status" class="form-select">
                            <option value="1" {{ $department->status == 1 ? 'selected' : '' }}>Activo</option>
                            <option value="0" {{ $department->status == 0 ? 'selected' : '' }}>Inactivo</option>
                        </select>
                        <x-validation field="status" />
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('departments') }}" class="btn btn-danger btn-md">Cancelar</a>
                        <button type="submit" class="btn btn-primary btn-md">Actualizar</button>
                    </div>
            </form>
        </div>
    </div>
@endsection
