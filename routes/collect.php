<?php

use App\Http\Controllers\CollectController;
use Illuminate\Support\Facades\Route;




Route::get('coll', [CollectController::class, 'index']);

Route::get('complex', [CollectController::class, 'complex']);

Route::get('filter', [CollectController::class, 'filter']);

Route::get('transform', [CollectController::class, 'transform']);

