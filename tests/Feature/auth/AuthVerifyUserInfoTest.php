<?php

namespace Tests\Feature\auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthVerifyUserInfoTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_verify_user_information_method()
    {
        $user = User::factory(1)->create();

        $response = $this->post(route('verify-user-information'), [
            'email' => $user->first()->email,
            'identification' => $user->first()->identification,
        ]);

        $response->assertRedirect(route('reset-password'));
        $response->assertSessionHas('user_update');
        $response->assertSessionHas('success');
    }

    public function test_verify_user_information_method_with_invalid_data()
    {
        $response = $this->post(route('verify-user-information'), [
            'email' => 'email',
            'identification' => '1234567890',
        ]);

        $response->assertSessionHas('error');
        $response->assertSessionMissing('user_update');
        $response->assertRedirect();
    }
}
