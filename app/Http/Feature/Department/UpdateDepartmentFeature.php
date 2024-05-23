<?php

namespace App\Http\Feature\Department;

use App\Foundation\Feature;
use App\Models\Department;
use Exception;
use Illuminate\Support\Facades\DB;

class UpdateDepartmentFeature extends Feature
{
    /**
     * Handle the update department feature.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handle()
    {
        try {
            DB::beginTransaction();

            $department = Department::find($this->request->id);

            if (!$department) {
                return redirect()->back()->with('error', 'No se encontró el departamento a editar.');
            }

            $department->update($this->request->all());

            DB::commit();
            return redirect()->route('departments')->with('success', 'Departamento actualizado con éxito.');
        } catch (Exception $th) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Ocurrió un error al actualizar el departamento.');
        }
    }
}
