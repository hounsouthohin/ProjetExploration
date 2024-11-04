<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;



Route::get('/connexion',[AuthController::class,'connexion']);

Route::get('/inscription',[AuthController::class,'inscription']);


 
//Route::post('/connexion', [PostController::class, 'store']);
Route::get('/inscription', [PostController::class, 'createInscription']);
Route::get('/connexion', [PostController::class, 'createConnexion']);

Route::post('/connexion', [PostController::class, 'store']);
Route::post('/inscription', [PostController::class, 'store']);
