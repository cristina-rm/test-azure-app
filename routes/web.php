<?php

use App\Http\Controllers\FrontendController;
use App\Http\Livewire\Permissions;
use App\Http\Livewire\Roles;
use App\Http\Livewire\Users;
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

/*Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');*/

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/', [FrontendController::class, 'index'])->name('welcome');

    Route::get('/admin', function () {
        return redirect()->route('users');
    })->name('dashboard');

    // Admin dashboard
    Route::prefix('admin')->middleware(['auth:sanctum', 'verified'])->group(function () {
        Route::get('users', Users::class)->name('users')->middleware('role:Admin|User Manager');
        Route::get('roles', Roles::class)->name('roles')->middleware('role:Admin');
        Route::get('permissions', Permissions::class)->name('permissions')->middleware('role:Admin');
    });
});
