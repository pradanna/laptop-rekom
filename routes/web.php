<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\AuthController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::get('/', [AdminController::class, 'dashboard']);
    Route::resource('item', \App\Http\Controllers\Admin\ItemController::class)->except(['show']);

    Route::get('/member', [\App\Http\Controllers\Admin\MemberController::class, 'index'])->name('member.index');
    Route::get('/member/{id}', [\App\Http\Controllers\Admin\MemberController::class, 'show'])->name('member.show');

    Route::resource('transaction', \App\Http\Controllers\Admin\TransactionController::class);
});

Route::middleware(['auth', 'role:pembeli'])->group(function () {
    Route::get('/dashboard/pembeli', function () {
        return view('pembeli.dashboard');
    })->middleware(['auth', 'role:teacher']);
});
