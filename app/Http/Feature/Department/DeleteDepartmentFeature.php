<?php

namespace App\Http\Feature\Department;

use App\Foundation\Feature;
use App\Models\Department;
use Exception;
use Illuminate\Support\Facades\DB;

class DeleteDepartmentFeature extends Feature
{
    /**
     * Handle the deletion of a department.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handle()
    {
        try {
            DB::beginTransaction();

            $department = Department::find($this->request->id);

            if (!$department) {
                return redirect()->back()->with('error', 'No se encontró el departamento a eliminar.');
            }

            $department->delete();

            DB::commit();
            return redirect()->back()->with('success', 'Departamento eliminado con éxito.');
        } catch (Exception $th) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Ocurrió un error al eliminar el departamento.');
        }
    }
}
