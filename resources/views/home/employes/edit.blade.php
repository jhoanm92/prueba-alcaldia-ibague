@extends('layouts.app')

@section('content')
    <div class="container d-flex justify-content-center mt-2 mb-2">
        <div class="row">
            <div class="container">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <h1>
                            Editar empleado
                        </h1>
                    </div>
                </div>
            </div>
            @if (session('error'))
                <x-alert color="danger">
                    {{ session('error') }}
                </x-alert>
            @endif
            <form method="post" action="{{ route('update-employe', ['id' => $employe->id]) }}" class="mb-3">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="mb-3 col-md-6 col-sm-12">
                        <label for="name" class="form-label">Nombre</label>
                        <input type="text" class="form-control" name="name" value="{{ $employe->name }}">
                        <x-validation field="name" />
                    </div>
                    <div class="mb-3 col-md-6 col-sm-12">
                        <label for="lastname" class="form-label">Apellido</label>
                        <input type="text" class="form-control" name="lastname" value="{{ $employe->lastname }}">
                        <x-validation field="lastname" />
                    </div>
                    <div class="mb-3 col-md-6 col-sm-12">
                        <label for="identification" class="form-label">Identificacion</label>
                        <input type="number" class="form-control" name="identification" min="3"
                            value="{{ $employe->identification }}">
                        <x-validation field="identification" />
                    </div>
                    <div class="mb-3 col-md-6 col-sm-12">
                        <label for="email" class="form-label">Correo electronico</label>
                        <input type="email" class="form-control" name="email" value="{{ $employe->email }}">
                        <x-validation field="email" />
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="birthday" class="form-label">Fecha Nacimiento</label>
                        <input type="date" class="form-control" name="birthday"
                            value="{{ date('Y-m-d', strtotime($employe->birthday)) }}">
                        <x-validation field="birthday" />
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="phone" class="form-label">Telefono</label>
                        <input type="phone" class="form-control" name="phone" value="{{ $employe->phone }}">
                        <x-validation field="phone" />
                    </div>
                    <div class="mb-3 col-md-6 col-sm-12">
                        <label for="address" class="form-label">Contraseña</label>
                        <input type="text" class="form-control" name="address" value="{{ $employe->address }}">
                        <x-validation field="address" />
                    </div>
                    <div class="mb-3 col-md-6 col-sm-12">
                        <label for="sex" class="form-label">Sexo</label>
                        <select class="form-select" name="sex">
                            <option value="M" {{ $employe->sex == 'M' ? 'selected' : '' }}>Masculino</option>
                            <option value="F" {{ $employe->sex == 'F' ? 'selected' : '' }}>Femenino</option>
                        </select>

                        <x-validation field="sex" />
                    </div>

                    <div class="mb-3 col-md-12 col-sm-12">
                        <label for="department_id" class="form-label">Departamento</label>
                        <select class="form-select" name="department_id">
                            @foreach ($departments as $department)
                                <option value="{{ $department->id }}"
                                    {{ $employe->department_id == $department->id ? 'selected' : '' }}>
                                    {{ $department->name }}
                                </option>
                            @endforeach
                        </select>
                        <x-validation field="department_id" />
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <a href="{{ route('employes') }}" class="btn btn-danger btn-md">Cancelar</a>
                    <button type="submit" class="btn btn-primary btn-md">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
@endsection
