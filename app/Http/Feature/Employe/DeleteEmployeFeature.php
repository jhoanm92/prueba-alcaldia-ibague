<?php

namespace App\Http\Feature\Employe;

use App\Foundation\Feature;
use App\Models\Employe;
use Exception;

class DeleteEmployeFeature extends Feature
{
    /**
     * Handle the deletion of an employee.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handle()
    {
        try {
            $employe = Employe::find($this->request->id);

            if (!$employe) {
                return redirect()->route('employes')->with('error', 'Empleado no encontrado');
            }

            $employe->delete();

            return redirect()->route('employes')->with('success', 'Empleado eliminado correctamente');
        } catch (Exception $e) {
            return redirect()->route('employes')->with('error', 'Ocurrió un error al eliminar el empleado');
        }
    }
}
