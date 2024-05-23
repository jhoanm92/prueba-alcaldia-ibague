<?php

namespace Tests\Feature\auth;

use App\Http\Controllers\auth\AuthController;
use App\Http\Feature\Auth\RegisterUserFeature;
use App\Http\Requests\auth\UserStoreRequest;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\RedirectResponse;
use Tests\TestCase;

class AuthRegisterTest extends TestCase
{

    use RefreshDatabase, WithFaker;


    public function test_register_user_method()
    {
        $controller = new AuthController();

        $request = new UserStoreRequest([
            'name' => 'John Doe',
            'lastname' => 'Doe',
            'email' => 'email@email.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'identification' => '1234567890',
            'birthday' => '1990-01-01',
        ]);

        $response = $controller->registerUser($request);

        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertDatabaseHas('users', [
            'name' => 'John Doe',
            'lastname' => 'Doe',
            'email' => 'email@email.com',
            'identification' => '1234567890',
            'birthday' => '1990-01-01',
        ]);
        $this->assertEquals(route('login'), $response->getTargetUrl());
    }

    public function test_register_user_method_with_invalid_data()
    {
        $response = $this->post(route('register'), [
            'name' => 'John Doe',
            'lastname' => 'Doe',
            'email' => 'email',
            'password' => 'password',
            'password_confirmation' => 'password',
            'identification' => '1234567890',
            'birthday' => '1990-01-01',
        ]);

        $response->assertSessionHasErrors(['email']);
    }

    public function test_register_user_method_with_existing_email()
    {
        $user = User::factory(1)->create();

        $response = $this->post(route('register'), [
            'name' => 'John Doe',
            'lastname' => 'Doe',
            'email' => $user->first()->email,
            'password' => 'password',
            'password_confirmation' => 'password',
            'identification' => '1234567890',
            'birthday' => '1990-01-01',
        ]);

        $response->assertSessionHasErrors(['email']);
    }
}
