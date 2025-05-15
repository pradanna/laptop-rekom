<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\TransactionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\LandingController;
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

Route::get('/', [LandingController::class, 'index'])->name('landing');
Route::get('/search', [LandingController::class, 'index'])->name('search');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/item/{id}', [ItemController::class, 'show'])->name('item.show');
Route::post('/cart/add/{id}', [CartController::class, 'store'])->name('cart.add');
Route::post('/checkout/buy/{id}', [TransactionController::class, 'buy'])->name('checkout.buy');


Route::get('/transactions', [\App\Http\Controllers\TransactionController::class, 'index'])->name('transaction.index');
Route::get('/transactions/{id}', [\App\Http\Controllers\TransactionController::class, 'show'])->name('transaction.show');
Route::get('/search/ajax', [ItemController::class, 'searchAjax'])->name('search.ajax');



Route::middleware('auth')->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/checkout/cart', [App\Http\Controllers\TransactionController::class, 'checkoutCart'])->name('checkout.cart');
    Route::get('/checkout', [\App\Http\Controllers\TransactionController::class, 'create'])->name('transaction.create');
    Route::post('/checkout', [\App\Http\Controllers\TransactionController::class, 'store'])->name('transaction.store');
});
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::get('/', [AdminController::class, 'dashboard']);
    Route::resource('item', \App\Http\Controllers\Admin\ItemController::class)->except(['show']);

    Route::get('/member', [\App\Http\Controllers\Admin\MemberController::class, 'index'])->name('member.index');
    Route::get('/member/{id}', [\App\Http\Controllers\Admin\MemberController::class, 'show'])->name('member.show');

    Route::get('transactions', [TransactionController::class, 'index'])->name('transactions.index');
    Route::get('transactions/{transaction}', [TransactionController::class, 'show'])->name('transactions.show');
    Route::post('transactions/{transaction}/accept', [TransactionController::class, 'accept'])->name('transactions.accept');
    Route::post('transactions/{transaction}/reject', [TransactionController::class, 'reject'])->name('transactions.reject');
    Route::patch('/admin/transactions/{transaction}/{status}', [TransactionController::class, 'updateStatus'])->name('transactions.updateStatus');
    Route::get('/admin/transactions/export', [TransactionController::class, 'export'])->name('transactions.export');
});

Route::middleware(['auth', 'role:pembeli'])->group(function () {
    Route::get('/dashboard/pembeli', function () {
        return view('pembeli.dashboard');
    })->middleware(['auth', 'role:teacher']);
});
