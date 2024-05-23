<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use App\Http\Feature\Department\AllDepartmentsFeature;
use App\Http\Feature\Department\DeleteDepartmentFeature;
use App\Http\Feature\Department\StoreDepartmentFeature;
use App\Http\Feature\Department\UpdateDepartmentFeature;
use App\Http\Requests\department\StoreRequest;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmetController extends Controller
{
    public function index()
    {
        return view('home.departments.index');
    }

    public function create()
    {
        return view('home.departments.create');
    }

    public function edit($id)
    {
        $department = Department::find($id);

        if (!$department) {
            return redirect()->back()->with('error', 'No se encontró el departamento a editar.');
        }

        return view('home.departments.edit', compact('department'));
    }

    public function getAllDepartments(Request $request)
    {
        return AllDepartmentsFeature::dispatchSync($request);
    }

    public function store(StoreRequest $request)
    {
        return StoreDepartmentFeature::dispatchSync($request);
    }

    public function delete(Request $request)
    {
        return DeleteDepartmentFeature::dispatchSync($request);
    }

    public function update(StoreRequest $request)
    {
        return UpdateDepartmentFeature::dispatchSync($request);
    }
}
