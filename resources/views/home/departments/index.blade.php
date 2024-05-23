@extends('layouts.app')

@section('content')
    {{-- welcome home --}}
    <div class="row">
        <h1 class="mb-3">Gestion departamentos</h1>

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
                    <a href="{{ route('create-department') }}" class="btn btn-primary btn-md">
                        Crear departamento
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <input type="text" class="form-control" id="search" placeholder="Buscar departamento">
                </div>
                <div class="col-md-3">
                    <select class="form-select" id="status">
                        <option value="">Estado</option>
                        <option value="active">Activo</option>
                        <option value="inactive">Inactivo</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <select class="form-select" id="perPage">
                        <option value="3">3</option>
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="15">15</option>
                    </select>
                </div>

            </div>
        </div>

        <table class="table mt-3">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Empleado</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody id="table-response">
                <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>
                        <a class="btn btn-primary btn-md">
                            (2) Ver
                        </a>
                    </td>
                    <td>
                        <div class="d-flex justify-content-evenly">
                            <a class="btn btn-primary btn-sm">
                                Editar
                            </a>
                            <form action="" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    Eliminar
                                </button>
                            </form>

                        </div>
                    </td>
                </tr>
            </tbody>

            {{-- add buttons paginate --}}
        </table>
        <div id="foot-table" class="d-flex justify-content-around align-items-center mt-3 mb-3">
        </div>
    </div>

    @push('custom-js')
        <script src="{{ asset('js/libraries/jquery.min.js') }}"></script>
        <script>
            let allDepartments = "{{ route('all-departments') }}";
            let deleteDepartment = "{{ route('delete-department') }}";
            let editDepartment = "{{ route('edit-department', ['id' => ':id']) }}";

            function getDepartments(search = '', status = '', page = 1, perPage= 5) {

                console.log(search, status, page, perPage);
                $.ajax({
                    url: allDepartments,
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        page: page,
                        per_page: perPage,
                        search: search,
                        status: status
                    },
                    success: function(response) {
                        let table = $('#table-response');
                        let footTable = $('#foot-table');
                        table.empty();
                        footTable.empty();

                        console.log(response);

                        response.data.forEach((department, index) => {
                            let row = `
                                    <tr>
                                        <th scope="row">${department.id}</th>
                                        <td>${department.name}</td>
                                        <td>${department.status}</td>
                                        <td>
                                            <a class="btn btn-primary btn-md">
                                                (2) Ver
                                            </a>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-evenly">
                                                <a href="${editDepartment.replace(':id', department.id)}" class="btn btn-primary btn-sm">
                                                    Editar
                                                </a>
                                                <form action="${deleteDepartment}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="id" value="${department.id}">
                                                    <button type="submit" onClick="confirm('Eliminar registro?')" class="btn btn-danger btn-sm">
                                                        Eliminar
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                `;

                            table.append(row);
                        });

                        let previous = `
                                <button type="button" onClick="getDepartments('${search}', '${status}', ${response.current_page > 0 ? response.current_page - 1 : 0}, ${perPage})" class="btn btn-primary btn-sm">
                                    Anterior
                                </button>
                            `;

                        footTable.append(previous);

                        for (let i = 1; i <= response.last_page; i++) {
                            let page = `
                                    <button type="button" onClick="getDepartments('${search}', '${status}', ${i}, ${perPage})" class="btn ${response.current_page == i ? 'btn-secondary' : 'btn-primary'} btn-sm">
                                        ${i}
                                    </button>
                                `;

                            footTable.append(page);
                        }

                        let next = `
                                <button type="button" onClick="getDepartments('${search}', '${status}', ${response.current_page == response.last_page ? response.current_page : response.current_page + 1}, ${perPage})" class="btn btn-primary btn-sm">
                                    Siguiente
                                </button>
                            `;

                        footTable.append(next);
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            }


            $(document).ready(function() {
                let search = $('#search');
                let status = $('#status');
                let perPage = $('#perPage');

                getDepartments();

                $('#search').keyup(function() {
                    getDepartments($(this).val(), status.val(), 1, perPage.val());
                });

                $('#status').change(function() {
                    getDepartments(search.val(), $(this).val(), 1, perPage.val());
                });

                $('#perPage').change(function() {
                    getDepartments(search.val(), status.val(), 1, $(this).val());
                });
            });
        </script>
    @endpush
@endsection
