<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

###### Sala ######

Route::resource('sala', \App\Http\Controllers\SalaController::class)->except(['show']);
Route::post(
    '/sala/search',
    [\App\Http\Controllers\SalaController::class, 'search']
)->name('sala.search');

###### fim Sala ######
