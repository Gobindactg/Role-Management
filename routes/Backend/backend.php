<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\RolesController;
use App\Http\Controllers\Backend\UsersController;
use App\Http\Controllers\Backend\AdminsController;
use App\Http\Controllers\Backend\sController;
use App\Http\Controllers\Backend\auth\LoginController;

use RealRashid\SweetAlert\Facades\Alert;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/admin', function () {
//     return view('Backend.Pages.index');
// });

Route::get('/admin', [AdminsController::class, 'admin'])->name('dashboard');

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'admin', 'auth' => 'admin'], function () {

    Route::resource('roles', RolesController::class);
    Route::resource('users', UsersController::class);
    Route::resource('admins', AdminsController::class);

    // Login Routes
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login/submit', [LoginController::class, 'login'])->name('admin.login.submit');

    //log out route
    Route::post('/logout/submit', [LoginController::class, 'logout'])->name('admin.logout.submit');


    // password reset
    Route::get('/password/reset', [LoginController::class, 'showLinkRequestForm'])->name('admin.password.request');
    Route::get('/password/reset/submit', [LoginController::class, 'reset'])->name('admin.password.update');


    Route::get('/add-permission', [RolesController::class, 'permission'])->name('permission');
    Route::post('/store-permission', [RolesController::class, 'permissionStore'])->name('permission.store');
});
