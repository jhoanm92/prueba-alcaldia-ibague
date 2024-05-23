<?php

namespace Tests\Feature\auth;

use App\Http\Controllers\Auth\AuthController;
use App\Http\Feature\Auth\LoginUserFeature;
use App\Http\Feature\Auth\RegisterUserFeature;
use App\Http\Requests\Auth\UserLoginRequest;
use App\Http\Requests\Auth\UserStoreRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\View\View;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test case for the login method in the AuthController class.
     *
     * This test verifies that the login method returns an instance of the View class.
     */
    public function test_login_method_returns_view()
    {
        $controller = new AuthController();

        $response = $controller->login();

        $this->assertInstanceOf(View::class, $response);
    }

    /**
     * Test case to verify that the register method returns a view.
     */
    public function test_register_method_returns_view()
    {
        $controller = new AuthController();

        $response = $controller->register();

        $this->assertInstanceOf(View::class, $response);
    }

    /**
     * Test case to verify that the verifyUser method in the AuthController class returns a View instance.
     */
    public function test_verify_user_method_returns_view()
    {
        $controller = new AuthController();

        $response = $controller->verifyUser();

        $this->assertInstanceOf(View::class, $response);
    }

    public function test_reset_password_method_returns_view()
    {
        $controller = new AuthController();

        session()->put('user_update', 1);
        $response = $controller->resetPassword();

        $this->assertInstanceOf(View::class, $response);
        $this->assertNotNull(session()->get('user_update'));
    }

    public function test_reset_password_method_redirects_to_verify_user()
    {
        $controller = new AuthController();

        $response = $controller->resetPassword();

        $this->assertNull(session()->get('user_update'));
        $this->assertEquals(route('verify-user'), $response->getTargetUrl());
    }
}
