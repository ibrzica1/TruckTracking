<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShipmentController;
use App\Http\Controllers\ShipmentFileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('profile/change-avatar', [ProfileController::class, 'changeAvatar'])->name('profile.change.avatar');
});

Route::resource('/', ShipmentController::class);

Route::resource('shipments', ShipmentController::class);
Route::post('/shipments/{shipment}/assignUser',[ShipmentController::class,'assignUser'])
->name('shipment.assign.user');

Route::get('shipment-files/show/{shipmentFile}', [ShipmentController::class, 'showFile'])->name('shipment.files.show');

require __DIR__.'/auth.php';
