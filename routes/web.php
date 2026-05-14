<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IngredienteController;
use App\Http\Controllers\PratoController;
use App\Http\Controllers\FichaTecnicaController;

Route::get('/', function () {
    return view('home');
});

Route::resource('ingredientes', IngredienteController::class);
Route::resource('pratos', PratoController::class);
Route::resource('fichas-tecnicas', FichaTecnicaController::class);