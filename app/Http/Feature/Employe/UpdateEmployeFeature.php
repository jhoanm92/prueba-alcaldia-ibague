<?php

namespace App\Http\Feature\Employe;

use App\Foundation\Feature;
use App\Models\Employe;
use Exception;
use Illuminate\Support\Facades\DB;

class UpdateEmployeFeature extends Feature
{
    /**
     * Handle the update employe feature.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handle()
    {
        try {
            DB::beginTransaction();

            $employe = Employe::find($this->id);

            if (!$employe) {
                return redirect()->route('employes')->with('error', 'Empleado no encontrado');
            }

            $employe->update($this->request->all());

            DB::commit();

            return redirect()->route('employes')->with('success', 'Empleado actualizado correctamente');
        } catch (Exception $e) {
            DB::rollBack();

            return redirect()->route('employes')->with('error', 'Ocurrió un error al actualizar el empleado');
        }
    }
}
