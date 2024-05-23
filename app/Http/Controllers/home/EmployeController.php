<?php

namespace App\Http\Controllers\home;

use App\DataTables\EmployesDataTable;
use App\Http\Controllers\Controller;
use App\Http\Feature\Employe\DeleteEmployeFeature;
use App\Http\Feature\Employe\StoreEmployeFeature;
use App\Http\Feature\Employe\UpdateEmployeFeature;
use App\Http\Requests\employe\StoreRequest;
use App\Http\Requests\employe\UpdateRequest;
use App\Models\Department;
use App\Models\Employe;
use Illuminate\Http\Request;

class EmployeController extends Controller
{
    public function index(EmployesDataTable $dataTable)
    {
        return $dataTable->render('home.employes.index');
    }

    public function edit($id)
    {
        $employe = Employe::find($id);

        if (!$employe) {
            return redirect()->route('employes')->with('error', 'Empleado no encontrado');
        }

        $departments = Department::all();

        return view('home.employes.edit', compact('employe', 'departments'));
    }

    public function create()
    {
        $departments = Department::all();

        return view('home.employes.create', compact('departments'));
    }

    public function update(UpdateRequest $request)
    {
        return UpdateEmployeFeature::dispatchSync($request, $request->id);
    }

    public function delete(Request $request)
    {
        return DeleteEmployeFeature::dispatchSync($request);
    }

    public function store(StoreRequest $request)
    {
        return StoreEmployeFeature::dispatchSync($request);
    }
}
