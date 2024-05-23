<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Http\Feature\Auth\ChangePasswordUserFeature;
use App\Http\Feature\Auth\LoginUserFeature;
use App\Http\Feature\Auth\LogoutFeature;
use App\Http\Feature\Auth\RegisterUserFeature;
use App\Http\Feature\Auth\VerifyUserInformationFeature;
use App\Http\Requests\auth\ChangePasswordUserRequest;
use App\Http\Requests\auth\UserLoginRequest;
use App\Http\Requests\auth\UserStoreRequest;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        if (session()->has('user_update')) {
            session()->forget('user_update');
        }

        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function verifyUser()
    {
        return view('auth.verify-user');
    }

    public function resetPassword()
    {
        if (!session()->has('user_update')) {
            return redirect()->route('verify-user');
        }

        return view('auth.reset-password');
    }

    public function registerUser(UserStoreRequest $request)
    {
        return RegisterUserFeature::dispatchSync($request);
    }

    public function loginUser(UserLoginRequest $request)
    {
        return LoginUserFeature::dispatchSync($request);
    }

    public function verifyUserInformation(Request $request)
    {
        return VerifyUserInformationFeature::dispatchSync($request);
    }

    public function changePassword(ChangePasswordUserRequest $request)
    {
        return ChangePasswordUserFeature::dispatchSync($request);
    }

    public function logout()
    {
        return LogoutFeature::dispatchSync();
    }
}
