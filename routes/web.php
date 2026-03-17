<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FnbController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\FrontController;

Route::get('/', [FrontController::class, 'index'])->name('front');
Route::post('/booking/tv', [FrontController::class, 'bookingTv'])->name('front.booking');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified', 'admin'])->group(function () {

    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::get('/dashboard', function () {
        return redirect()->route('home');
    })->name('dashboard');

    Route::get('/rental', [DashboardController::class, 'index'])->name('rental');
    Route::post('/consoles/store', [DashboardController::class, 'store'])->name('consoles.store');
    Route::delete('/consoles/{id}', [DashboardController::class, 'destroy'])->name('consoles.destroy');

    Route::post('/booking/start', [DashboardController::class, 'startSession'])->name('booking.start');
    Route::post('/booking/stop/{id}', [DashboardController::class, 'stopSession'])->name('booking.stop');
    Route::post('/booking/toggle/{id}', [DashboardController::class, 'toggleTimer'])->name('booking.toggle');
    Route::post('/booking/add-order', [DashboardController::class, 'addOrder'])->name('booking.addOrder');

    Route::get('/fnb', [FnbController::class, 'index'])->name('fnb.index');
    Route::post('/fnb', [FnbController::class, 'store'])->name('fnb.store');
    Route::post('/fnb/update/{id}', [FnbController::class, 'update'])->name('fnb.update_post');
    Route::patch('/fnb/{id}/stock', [FnbController::class, 'updateStock'])->name('fnb.quick_stock');
    Route::delete('/fnb/{id}', [FnbController::class, 'destroy'])->name('fnb.destroy');
    Route::get('/fnb/order', [FnbController::class, 'cashier'])->name('fnb.cashier');

    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::resource('members', MemberController::class);
    Route::post('/members/{id}/topup', [MemberController::class, 'topup'])->name('members.topup');
});

require __DIR__ . '/auth.php';
