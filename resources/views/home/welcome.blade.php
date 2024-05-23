@extends('layouts.app')

@section('content')
    <div class="container d-flex justify-content-center mt-2 mb-2">
        {{-- welcome home --}}
        <div class="row">
            <h1>Bienvenido {{Auth::user()->name}} a la pagina de inicio</h1>

            <p>Esta es la pagina de inicio de la aplicacion</p>
        </div>
    </div>
@endsection
