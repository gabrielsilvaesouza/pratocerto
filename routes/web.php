<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IngredienteController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('ingredientes', IngredienteController::class);
