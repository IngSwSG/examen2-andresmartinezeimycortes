<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MaterialController;

Route::get('/', function () {
    return view('welcome');
});

// Rutas API sin protección CSRF
Route::post('/api/materials', [MaterialController::class, 'store'])
    ->middleware('api')
    ->withoutMiddleware(\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class);

// --- Rutas web ---


