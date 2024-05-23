<?php

namespace App\Http\Feature\Auth;

use App\Foundation\Feature;
use App\Models\User;
use Exception;
use Illuminate\Contracts\Session\Session;

class VerifyUserInformationFeature extends Feature
{
    /**
     * Handle the verification of user information.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handle()
    {
        try{
            $user = User::where('identification', $this->request->identification)
                ->where('email', $this->request->email)
                ->first();

            if(!$user){
                return redirect()->back()->with('error', 'No se encontró un usuario con la información proporcionada.');
            }

            session()->put('user_update', $user->id);
            return redirect()->route('reset-password')->with('success', 'Usuario verificado con éxito.');
        }catch(Exception $e){
            return redirect()->back()->with('error', 'Ocurrió un error al verificar la información del usuario.');
        }
    }
}
