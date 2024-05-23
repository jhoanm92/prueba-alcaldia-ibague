<?php

use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\home\DepartmetController;
use App\Http\Controllers\home\EmployeController;
use App\Http\Controllers\home\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::controller(AuthController::class)->group(function () {
    Route::get('/', 'login')->name('login');
    Route::get('/registro', 'register')->name('register');
    Route::get('/olvidaste-tu-contrasena', 'verifyUser')->name('verify-user');
    Route::get('/cambiar-tu-contrasena', 'resetPassword')->name('reset-password');

    Route::post('/registro', 'registerUser')->name('register-user');
    Route::post('/', 'loginUser')->name('login-user');
    Route::post('/olvidaste-tu-contrasena', 'verifyUserInformation')->name('verify-user-information');
    Route::post('/cambiar-tu-contrasena', 'changePassword')->name('change-password');
});


/* routes auth */
Route::middleware('auth')->group(function () {
    Route::controller(HomeController::class)->group(function () {
        Route::get('/home', 'index')->name('home');
    });

    Route::controller(DepartmetController::class)->group(function () {
        Route::get('/departamentos', 'index')->name('departments');
        Route::get('/departamentos/all', 'getAllDepartments')->name('all-departments');
        Route::get('/departamentos/crear', 'create')->name('create-department');
        Route::post('/departamentos/crear', 'store')->name('store-department');
        Route::delete('/departamentos/eliminar', 'delete')->name('delete-department');
        Route::get('/departamentos/editar/{id}', 'edit')->name('edit-department');
        Route::put('/departamentos/editar/{id}', 'update')->name('update-department');
    });

    Route::controller(EmployeController::class)->group(function () {
        Route::get('/empleados', 'index')->name('employes');
        Route::get('/empleados/editar/{id}', 'edit')->name('edit-employe');
        Route::put('/empleados/editar/{id}', 'update')->name('update-employe');
        Route::delete('/empleados/eliminar', 'delete')->name('delete-employe');
        Route::get('/empleados/crear', 'create')->name('create-employe');
        Route::post('/empleados/crear', 'store')->name('store-employe');
    });

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});
