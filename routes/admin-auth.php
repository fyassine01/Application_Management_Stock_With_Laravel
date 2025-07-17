<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\ProduitsControlleur;
use App\Http\Controllers\Admin\ProfilControlleur;
use App\Http\Controllers\Admin\AdminCommandesController;
use App\Http\Controllers\Admin\MouvementsControlleur;
use App\Http\Controllers\Admin\DashbordControlleur;
use App\Http\Controllers\Admin\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;

Route::prefix('admin')->middleware('guest:admin')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])->name('admin.register');
    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [LoginController::class, 'create'])->name('admin.login');
    Route::post('login', [LoginController::class, 'store']);

});

Route::prefix('admin')->middleware('auth:admin')->group(function () {
    /*Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');*/

    Route::get('/produits',[ProduitsControlleur::class,'index'])->name('produits');
    Route::post('/produits',[ProduitsControlleur::class,'ajouter'])->name('produit.ajouter');
    Route::delete('/produits/supprimer/{id_produit}', [ProduitsControlleur::class, 'supprimer'])->name('produit.supprimer');

    Route::get('/products/edit/{id_produit}', [ProduitsControlleur::class, 'edit'])->name('produit.editer');
    Route::post('/products/update/{id_produit}', [ProduitsControlleur::class, 'update'])->name('produit.mettreajour');
    Route::post('logout', [LoginController::class, 'destroy'])->name('admin.logout');
    Route::get('/dashboard',[DashbordControlleur::class,'index'])->name('admin.dashboard');

    //mouvements Routes
    Route::get('/mouvements',[MouvementsControlleur::class,'index'])->name('mouvements');
    Route::get("/mouvements/affiche",[MouvementsControlleur::class,'affiche'])->name('mouvements.affiche');
    Route::post("/mouvements/affiche",[MouvementsControlleur::class,'affiche'])->name('mouvements.affiche');
    Route::get('/mouvements/create', [MouvementsControlleur::class, 'create'])->name('mouvements.create');
    Route::post('/mouvements/create', [MouvementsControlleur::class, 'store'])->name('mouvements.store');

    //profil Routes
    Route::get('/profil',[ProfilControlleur::class,'index'])->name('profil'); 
    Route::put('/profil',[ProfilControlleur::class,'modifier'])->name('profil.modifier'); 

    //dashdoard Routes
    Route::get('/dashboard',[DashbordControlleur::class,'index'])->name('admin.dashboard');

    Route::get('/users', [AdminController::class, 'index'])->name('admin.users');
    Route::post('/users/create', [AdminController::class, 'store'])->name('admin.users.create');
    Route::delete('/users/{id}', [AdminController::class, 'destroy'])->name('admin.users.destroy');
    
    Route::get('/commandes', [AdminCommandesController::class,'index'])->name('admin.commandes.index');
    Route::patch('/commandes/{commande}/valider', [AdminCommandesController::class,'valider'])->name('commandes.valider');
    Route::patch('/commandes/{commande}/refuser', [AdminCommandesController::class,'refuser'])->name('commandes.refuser');

});
