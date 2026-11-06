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

###### Usuario ######

Route::resource('usuario', \App\Http\Controllers\UsuarioController::class)->except(['show']);
Route::post(
    '/usuario/search',
    [\App\Http\Controllers\UsuarioController::class, 'search']
)->name('usuario.search');

###### fim Usuario ######

###### Produto ######

Route::resource('produto', \App\Http\Controllers\ProdutoController::class)->except(['show']);
Route::post(
    '/produto/search',
    [\App\Http\Controllers\ProdutoController::class, 'search']
)->name('produto.search');

###### fim Produto ######

###### Playlist ######

Route::resource('playlist', \App\Http\Controllers\PlaylistController::class)->except(['show']);
Route::post(
    '/playlist/search',
    [\App\Http\Controllers\PlaylistController::class, 'search']
)->name('playlist.search');

###### fim Playlist ######

###### Reserva ######

Route::resource('reserva', \App\Http\Controllers\ReservaController::class)->except(['show']);
Route::post(
    '/reserva/search',
    [\App\Http\Controllers\ReservaController::class, 'search']
)->name('reserva.search');

###### fim Reserva ######

###### Compra ######

Route::resource('compra', \App\Http\Controllers\CompraController::class)->except(['show']);
Route::post(
    '/compra/search',
    [\App\Http\Controllers\CompraController::class, 'search']
)->name('compra.search');

###### fim Compra ######
