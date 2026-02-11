<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ComplaintController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    // Student Complaint Routes (Resource style)
    Route::resource('complaints', ComplaintController::class);

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Admin Routes
    Route::middleware(['admin'])->prefix('admin')->group(function () {
        Route::get('/complaints', [ComplaintController::class, 'adminIndex'])
            ->name('admin.complaints.index');
    });
});

require __DIR__.'/auth.php';