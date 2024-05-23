<?php

namespace Tests\Feature\auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthLoginTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_login_user_method()
    {

        User::factory()->create([
            'name' => 'John Doe',
            'lastname' => 'Doe',
            'email' => 'admin@admin.com',
            'password' => 'password',
            'identification' => '1234567890',
            'birthday' => '1990-01-01',
        ]);

        $response = $this->post(route('login'), [
            'email' => 'admin@admin.com',
            'password' => 'password',
        ]);

        $response->assertRedirect(route('home'));
    }

    public function test_login_user_method_with_invalid_data()
    {
        $response = $this->post(route('login'), [
            'email' => 'email',
            'password' => 'password',
        ]);

        $response->assertSessionHasErrors(['email']);
    }
}
