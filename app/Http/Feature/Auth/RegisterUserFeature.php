<?php

namespace App\Http\Feature\Auth;

use App\Foundation\Feature;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;

class RegisterUserFeature extends Feature
{
    /**
     * Handle the registration of a new user.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handle()
    {
        DB::beginTransaction();
        try {
            User::create([
                'name' => $this->request->name,
                'lastname' => $this->request->lastname,
                'email' => $this->request->email,
                'identification' => $this->request->identification,
                'birthday' => $this->request->birthday,
                'password' => bcrypt($this->request->password),
            ]);

            DB::commit();

            return redirect()->route('login')->with('success', 'Usuario registrado con éxito.');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Ocurrió un error al registrar el usuario.');
        }
    }
}
