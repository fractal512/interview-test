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

Route::middleware(['auth:web'])->group(function() {

    // Client Dashboard
    Route::get('/dashboard-client', [App\Http\Controllers\Dashboard\ClientDashboardController::class, 'index'])->name('dashboard-client');
    Route::post('/dashboard-client', [App\Http\Controllers\Dashboard\ClientDashboardController::class, 'store'])->name('dashboard-client.store');

    // Manager Dashboard
    Route::get('/dashboard-manager', [App\Http\Controllers\Dashboard\ManagerDashboardController::class, 'index'])->name('dashboard-manager');
    Route::post('/dashboard-manager', [App\Http\Controllers\Dashboard\ManagerDashboardController::class, 'store'])->name('dashboard-manager.store');

});
