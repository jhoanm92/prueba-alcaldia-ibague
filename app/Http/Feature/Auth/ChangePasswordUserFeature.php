<?php

namespace App\Http\Feature\Auth;

use App\Foundation\Feature;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;

class ChangePasswordUserFeature extends Feature
{
    /**
     * Handle the change password request.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handle()
    {
        try {
            DB::beginTransaction();

            $user_id = session()->get('user_update');

            if (!$user_id) {
                return redirect()->route('verify-user')->with('error', 'No se encontró un usuario para cambiar la contraseña.');
            }

            $user = User::find($user_id);

            if (!$user) {
                return redirect()->route('verify-user')->with('error', 'No se encontró un usuario para cambiar la contraseña.');
            }

            $user->password = bcrypt($this->request->password);
            $user->save();

            session()->forget('user_update');

            DB::commit();
            return redirect()->route('login')->with('success', 'Contraseña cambiada con éxito.');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Ocurrió un error al cambiar la contraseña.');
        }
    }
}
