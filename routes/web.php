<?php

use App\Http\Controllers\Apps\AbsensiController;
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
    return \Inertia\Inertia::render('Auth/Login');
})->middleware('guest');

//prefix "admin"
Route::prefix('apps/admin')->group(function() {
    
    Route::group(['midlleware' => ['auth']], function () {

        Route::put('cutis/reject/{cuti}', \App\Http\Controllers\Apps\Admin\CutiController::class)->name('apps/admin.cutis.reject');

        Route::resource('/cutis', \App\Http\Controllers\Apps\Admin\CutiController::class, ['as' => 'apps/admin']);

    });

});

//prefix "pegawai"
Route::prefix('apps/pegawai')->group(function() {
    
    Route::group(['midlleware' => ['auth']], function () {

        Route::resource('/cutis', \App\Http\Controllers\Apps\Pegawai\CutiController::class, ['as' => 'apps/pegawai']);

    });

});

//prefix "apps"
Route::prefix('apps')->group(function() {

    //middleware "auth"
    Route::group(['middleware' => ['auth']], function () {

        //route dashboard
        Route::get('dashboard', App\Http\Controllers\Apps\DashboardController::class)->name('apps.dashboard');

        //route permissions
        Route::get('/permissions', \App\Http\Controllers\Apps\PermissionController::class)->name('apps.permission.index')
            ->middleware('permission:permissions.index');

            //route resource roles
        Route::resource('/roles', \App\Http\Controllers\Apps\RoleController::class, ['as' => 'apps'])
            ->middleware('permission:roles.index|roles.create|roles.edit|roles.delete');

        Route::resource('users', \App\Http\Controllers\Apps\UserController::class, ['as' => 'apps'])
            ->middleware('permission:users.index|users.create|users.edit|users.delete');

        Route::get('/absensi/master',[AbsensiController::class, 'master'])->name('apps.absensi.master')
            ->middleware('permission:absensis.master');

        Route::get('/absensi/master/filter', [AbsensiController::class, 'filter'])->name('apps.absensi.filter')
            ->middleware('permission:absensis.master');

        Route::resource('/absensi', \App\Http\Controllers\Apps\AbsensiController::class, ['as'  => 'apps'])
            ->middleware('permission:absensis.index|absensis.create|absensis.edit|absensis.delete');
            
    });
});

