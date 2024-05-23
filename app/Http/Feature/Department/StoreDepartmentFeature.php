<?php

namespace App\Http\Feature\Department;

use App\Foundation\Feature;
use App\Models\Department;
use Exception;
use Illuminate\Support\Facades\DB;

class StoreDepartmentFeature extends Feature
{
    /**
     * Handle the creation of a new department.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handle()
    {
        try{
            DB::beginTransaction();

            $department = Department::create([
                'name' => $this->request->name,
                'status' => $this->request->status
            ]);

            DB::commit();

            return redirect()->route('departments')->with('success', 'Departamento creado correctamente');
        }catch(Exception $e){
            DB::rollBack();
            return redirect()->route('departments')->with('error', 'Ocurrio un error al crear el departamento');
        }
    }
}
