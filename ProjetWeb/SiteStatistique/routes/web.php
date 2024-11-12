<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;

Route::get('/',[AuthController::class,'welcome'])->name('welcome');

Route::get('/connexion',[AuthController::class,'connexion'])->name('connexion');
Route::post('/connexion',[AuthController::class,'connexionPost'])->name('connexion.post');
Route::get('/inscription',[AuthController::class,'inscription'])->name('inscription');
Route::post('/inscription',[AuthController::class,'inscriptionPost'])->name('inscription.post');
Route::get('/logout',[AuthController::class,'logout'])->name('logout');

 
/*Route::post('/connexion', [PostController::class, 'store']);
Route::get('/inscription', [PostController::class, 'createInscription']);
Route::get('/connexion', [PostController::class, 'createConnexion']);

Route::post('/connexion', [PostController::class, 'store']);
Route::post('/inscription', [PostController::class, 'store']);*/
