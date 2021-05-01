<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PhotoController;
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

Route::group(["middleware" => "auth"], function() {
    Route::resource('photos', PhotoController::class);
    Route::get('/', [PhotoController::class, 'personalDashboard'])->name('dashboard');
    Route::get('photos/buy/{photo}', [\App\Http\Controllers\FinancialController::class, 'manageFinancialTransactions'])->name('photos.buy');
    Route::get('sales', [\App\Http\Controllers\SaleController::class, 'index'])->name('sales.index');
});

require __DIR__.'/auth.php';
