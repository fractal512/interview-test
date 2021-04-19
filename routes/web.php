<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

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
    /*$user = App\Models\User::find(1);
    dd($user->hasRole('manager'),
        $user->hasRole('client'),
        $user->givePermissionsTo('manage-requests'),
        $user->hasPermission('manage-requests'));*/
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/*Route::middleware(['role:client'])->group(function() {
    Route::get('/dashboard', function() {
        return 'client';
    });
});*/

/*Route::middleware(['auth', 'role:manager'])->group(function() {
    Route::get('/dashboard', function() {
        return 'manager';
    });
});

Route::middleware(['auth', 'role:client'])->group(function() {
    Route::get('/dashboard', function() {
        return 'client';
    });
});*/

Route::middleware(['auth:web'])->group(function() {

    /*if($request->user()->hasRole('client')) {
        Route::get('/dashboard', function () {
            return 'client';
        });
    }
    if($request->user()->hasRole('manager')) {
        Route::get('/dashboard', function () {
            return 'manager';
        });
    }*/

    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::post('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'store'])->name('dashboard.store');
});
