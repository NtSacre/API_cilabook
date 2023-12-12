<?php

use Illuminate\Http\Request;
use Laravel\Sanctum\Sanctum;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\AuthControlleur;
use App\Http\Controllers\UserControlleur;
use App\Http\Controllers\ProjetController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\ContactPorteurProjetController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/




   
// Debut de l'ensemble des routes pour la connexion et deconnexion utilisateur

    Route::post('register', [AuthControlleur::class, 'enregistrerUtilisateur']);
    Route::post('/login', [AuthControlleur::class, 'connecterUtilisateur']);
    Route::get('/logout', [AuthControlleur::class, 'deconnecterUtilisateur'])->middleware('auth:sanctum');
// FIN ----------------------------------------------------------------------------------------------------

// Debut de l'ensemble des routes pour les projet
Route::middleware('auth:sanctum','porteur')->group(function(){
Route::apiResource('/projet', ProjetController::class);
Route::post('modifierProjet/{projet}', [ProjetController::class, 'update']);

});
// FIN ----------------------------------------------------------------------------------------------------


// Debut de l'ensemble des routes pour l'admin 

Route::middleware('auth:sanctum','admin')->group(function(){
    Route::get('/utilisateurNonBloquer', [UserControlleur::class, 'listeUtilisateurNonBloquer']);
    Route::get('/utilisateurBloquer', [UserControlleur::class, 'listeUtilisateurBloquer']);

Route::get('toutPorteurNonBloquer', [UserControlleur::class, 'toutPorteurNonBloquer']);
Route::get('toutBailleurNonBloquer', [UserControlleur::class, 'toutBailleurNonBloquer']);
Route::post('bloquerUtilisateur/{user}', [UserControlleur::class, 'bloquerUtilisateur']);
Route::get('toutPorteurBloquer', [UserControlleur::class, 'toutPorteurBloquer']);
Route::get('toutBailleurBloquer', [UserControlleur::class, 'toutBailleurBloquer']);
Route::post('debloquerUtilisateur/{user}', [UserControlleur::class, 'debloquerUtilisateur']);


Route::apiResource('/categorie', CategorieController::class);
Route::apiResource('/role', RoleController::class);

});
// FIN ----------------------------------------------------------------------------------------------------


// Debut des routes pour la page d'acceuille 

Route::get('indexHome', [HomeController::class, 'index'])->name('indexHome');


// FIN ---------------------------------------------------------------------------------------------------


// Debut des routes pour le Bailleur

Route::middleware('auth:sanctum','bailleur')->group(function(){
     Route::get('showHome/{projet}', [HomeController::class, 'show'])->name('showHome');
Route::post('storeContact/{projet}', [ContactPorteurProjetController::class, 'store'])->name('storeContact');
Route::get('contactWhatsapp/{user}', [ContactPorteurProjetController::class, 'messageWhatsapp'])->name('messageWhatsapp');



});
// FIN ------------------------------------------------------------------------------------------------------------

/*
Si la personne n'est pas connecté et 
qu'elle souhaite se déconnecter, on le renvoie ce message 
ci dessous

*/
    Route::get('/login', function(){
        return response()->json([
            'error' => 'Unauthenticated',
            

        ], 401);
    })->name('login');


