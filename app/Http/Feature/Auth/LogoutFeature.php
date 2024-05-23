<?php
namespace App\Http\Feature\Auth;

use App\Foundation\Feature;

class LogoutFeature extends Feature
{
    /**
     * Handle the logout request.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handle()
    {
        auth()->logout();
        return redirect()->route('login');
    }
}
