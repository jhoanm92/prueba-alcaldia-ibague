<?php

namespace App\Http\Feature\Employe;

use App\Foundation\Feature;
use App\Models\Employe;
use Exception;
use Illuminate\Support\Facades\DB;

class StoreEmployeFeature extends Feature
{
    /**
     * Handle the creation of a new employee.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handle()
    {
        try {
            DB::beginTransaction();

            $employe = Employe::create($this->request->all());

            if ($employe) {
                DB::commit();
                return redirect()->route('employes')->with('success', 'Empleado creado correctamente');
            }

            DB::rollBack();
            return redirect()->route('create-employe')->with('error', 'Error al crear el empleado');
        } catch (Exception $th) {
            DB::rollBack();
            return redirect()->route('create-employe')->with('error', 'Error al crear el empleado');
        }
    }
}
