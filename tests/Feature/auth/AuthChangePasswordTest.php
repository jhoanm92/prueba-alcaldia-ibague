<?php

namespace Tests\Feature\auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthChangePasswordTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_change_password_method()
    {
        $user = User::factory(1)->create();
        session()->put('user_update', $user->first()->id);

        $response = $this->post(route('change-password'), [
            'password' => 'password',
            'password_confirmation' => 'password'
        ]);

        $response->assertRedirect(route('login'));
        $response->assertSessionHas('success');
        $response->assertSessionMissing('user_update');
    }

    public function test_user_not_found()
    {
        session()->put('user_update', 100);

        $response = $this->post(route('change-password'), [
            'password' => 'password',
            'password_confirmation' => 'password'
        ]);

        $response->assertRedirect(route('verify-user'));
        $response->assertSessionHas('error');
    }
}
