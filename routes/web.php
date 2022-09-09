<?php

use Illuminate\Support\Facades\Route;
use App\Http\controllers\admin\AdminLoginController;
use App\Http\controllers\admin\DashboardController;

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
    return view('welcome');
});



Route::group(['prefix' => 'admin'], function(){
    Route::group(['middleware' => 'admin.guest'], function(){
        Route::get('/login', [AdminLoginController::class, 'index'])->name('admin.login');
        Route::post('/login', [AdminLoginController::class, 'authenticate'])->name('admin.auth');
    });
    Route::group(['middleware' => 'admin.auth'], function(){
        //here we define password protected routes

        // Route::view('/dashboard', 'admin.dashboard')->name('admin.dashboard');
        Route::get('/dashboard',[DashboardController::class,'index'])->name('admin.dashboard');
        Route::get('/logout',[AdminLoginController::class,'logout'])->name('admin.logout');
    });
});
