<?php

namespace App\Http\Feature\Auth;

use App\Foundation\Feature;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;

class LoginUserFeature extends Feature
{
    /**
     * Handle the login request.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handle()
    {
        if (!auth()->attempt($this->request->only('email', 'password'))) {
            return redirect()->back()->with('error', 'Credenciales incorrectas.');
        }

        return redirect()->route('home');
    }
}
