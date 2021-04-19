<?php

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

Route::group(['middleware' => 'role:manager'], function() {
    Route::get('/dashboard', function() {
        return 'manger';
    });
});
