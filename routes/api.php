<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MaterialController;

Route::post('/materials', [MaterialController::class, 'store']);
