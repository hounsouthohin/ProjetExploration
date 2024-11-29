<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RolePermissions;
use App\Http\Controllers\StatistiqueController;

Route::middleware(['auth', 'role:utilisateur|admin'])->get('/stat1', [StatistiqueController::class, 'stat1'])->name('stat1');

Route::middleware(['auth', 'role:admin'])->get('/stat2', [StatistiqueController::class, 'stat2'])->name('stat2');


Route::get('/setup-roles-permissions', [RolePermissions::class, 'createRolesAndPermissions'])->name('setup.roles.permissions');
Route::get('/welcome',[AuthController::class,'welcome'])->name('welcome');
Route::get('/connexion', [AuthController::class, 'connexion'])->name('connexion');

// Route racine qui redirige vers connexion
Route::get('/', function () {
    return redirect()->route('connexion');
})->middleware(['throttle:tentatives']);
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [RolePermissions::class, 'adminPage'])->name('dashboard');
    Route::post('/user/{id}/update', [RolePermissions::class, 'updateUserRole'])->name('user.update');
    Route::delete('/user/{id}', [RolePermissions::class, 'deleteUser'])->name('user.delete');
});



//Route::get('/admin', [AuthController::class, 'admin'])->name('admin');
Route::post('/',[AuthController::class,'connexionPost'])->name('connexion.post');
Route::get('/inscription',[AuthController::class,'inscription'])->name('inscription');
Route::post('/inscription',[AuthController::class,'inscriptionPost'])->name('inscription.post');
Route::get('/logout',[AuthController::class,'deconnexion'])->name('logout');

 
/*Route::post('/connexion', [PostController::class, 'store']);
Route::get('/inscription', [PostController::class, 'createInscription']);
Route::get('/connexion', [PostController::class, 'createConnexion']);

Route::post('/connexion', [PostController::class, 'store']);
Route::post('/inscription', [PostController::class, 'store']);*/
