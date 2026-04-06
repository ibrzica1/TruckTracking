<?php

use App\Http\Controllers\ShipmentController;
use Illuminate\Support\Facades\Route;

Route::resource('/', ShipmentController::class);

Route::resource('shipments', ShipmentController::class);
