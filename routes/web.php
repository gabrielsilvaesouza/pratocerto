<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IngredienteController;
use App\Http\Controllers\PratoController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('ingredientes', IngredienteController::class);
Route::resource('pratos', PratoController::class);