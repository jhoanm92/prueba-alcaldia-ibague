<?php

namespace Tests\Feature\auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthLogoutTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_logout_method()
    {
        $user = User::factory(1)->create();

        $response = $this->actingAs($user->first())->get(route('logout'));

        $response->assertRedirect(route('login'));
        $this->assertGuest();
    }
}
