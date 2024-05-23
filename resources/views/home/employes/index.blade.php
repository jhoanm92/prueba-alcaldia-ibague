@extends('layouts.app')

@section('content')
    @push('custom-css')
        <link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.dataTables.css" />
    @endpush
    {{-- welcome home --}}
    <div class="row">
        <h1 class="mb-3">Gestion Empleado</h1>

        @if (session('success'))
            <x-alert color="success">
                {{ session('success') }}
            </x-alert>
        @endif
        @if (session('error'))
            <x-alert color="error">
                {{ session('error') }}
            </x-alert>
        @endif

        <div class="container">
            <div class="row mb-3">
                <div class="col-md-6">
                    <a href="{{ route('create-employe') }}" class="btn btn-primary btn-md">
                        Crear empleado
                    </a>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">Gestion Empleados</div>
            <div class="card-body">
                {{ $dataTable->table() }}
            </div>
        </div>
    </div>

    @push('custom-js')
        <script src="{{ asset('js/libraries/jquery.min.js') }}"></script>
        <script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>

        {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
    @endpush
@endsection
