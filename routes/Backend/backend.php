<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\RolesController;
use App\Http\Controllers\Backend\UsersController;
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

Route::get('/', function () {
    return view('Backend.Pages.index');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'admin'], function () {
   
    Route::resource('roles', RolesController::class);
});
Route::group(['prefix' => 'admin'], function () {
   
    Route::resource('users', UsersController::class);
});
Route::get('/add-permission', [RolesController::class, 'permission'])->name('permission');
Route::post('/store-permission', [RolesController::class, 'permissionStore'])->name('permission.store');
