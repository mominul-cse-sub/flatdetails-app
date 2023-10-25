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
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group( ['middleware' => ['web','can:admin'], 'prefix' => 'admin'],function () {
    Route::get('/', [App\Http\Controllers\Admin\AdminController::class, 'index'])->name('admin');
    Route::get('/flatowner', [\App\Http\Controllers\Admin\AdminController::class, 'flatowner'])->name('admin.flatowner');
    Route::get('/tenant', [\App\Http\Controllers\Admin\AdminController::class, 'tenant'])->name('admin.tenant');
});
Route::group( ['middleware' => ['web','can:flat_owner'], 'prefix' => 'flat'],function () {
    Route::resource('/', App\Http\Controllers\Fo\FlatOwnerController::class);
    Route::get('/allflat', [\App\Http\Controllers\Fo\FlatOwnerController::class, 'allflat'])->name('flat.allflat');
    Route::get('/inactiveflat', [\App\Http\Controllers\Fo\FlatOwnerController::class, 'inactiveflat'])->name('flat.inactiveflat');
    Route::get('/activeflat', [\App\Http\Controllers\Fo\FlatOwnerController::class, 'activeflat'])->name('flat.activeflat');
    Route::get('/profile', [\App\Http\Controllers\Fo\FlatOwnerController::class, 'profile'])->name('flat.profile');
    Route::put('/profileupdate', [\App\Http\Controllers\Fo\FlatOwnerController::class, 'profileupdate'])->name('flat.profileupdate');
    Route::get('/{id}', [\App\Http\Controllers\Fo\FlatOwnerController::class, 'show'])->name('flat.show');
    Route::get('/{id}/edit', [\App\Http\Controllers\Fo\FlatOwnerController::class, 'edit'])->name('flat.edit');
    Route::put('/flat/{id}', [\App\Http\Controllers\Fo\FlatOwnerController::class, 'update'])->name('flat.update');
    Route::delete('/{id}', [\App\Http\Controllers\Fo\FlatOwnerController::class, 'destroy'])->name('flat.destroy');
    Route::get('/inactive/{id}', [\App\Http\Controllers\Fo\FlatOwnerController::class, 'inactive'])->name('inactive');
    Route::get('/active/{id}', [\App\Http\Controllers\Fo\FlatOwnerController::class, 'active'])->name('active');
    Route::get('/{id}/imageupload', [\App\Http\Controllers\Fo\FlatOwnerController::class, 'addimage'])->name('addimage');
    Route::post('/upload/{flat}/image', [\App\Http\Controllers\Fo\FlatOwnerController::class, 'imageupload'])->name('imageupload');
    Route::delete('/imagedelete/{id}', [\App\Http\Controllers\Fo\FlatOwnerController::class, 'imagedelete'])->name('flat.imagedelete');


});
Route::group( ['middleware' => ['web','can:tenant'], 'prefix' => 'tenant'], function () {
    Route::get('/', [App\Http\Controllers\Tenant\TenantController::class, 'index'])->name('tenant');
    Route::get('/allflat', [App\Http\Controllers\Tenant\TenantController::class, 'allflat'])->name('tenant.allflat');
    Route::get('/{id}', [App\Http\Controllers\Tenant\TenantController::class, 'show'])->name('tenant.show');
});
