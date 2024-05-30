<?php

use App\Http\Controllers\TempController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/




Route::get('/add', [TempController::class, 'add'])->name('add');



Route::get('/', [TempController::class, 'index'])->name('documents.index'); // Afficher tous les documents
Route::get('/documents/create', [TempController::class, 'create'])->name('documents.create'); // Afficher le formulaire de création
Route::post('/documents', [TempController::class, 'store'])->name('documents.store'); // Enregistrer un nouveau document
Route::get('/documents/{id}', [TempController::class, 'show'])->name('documents.show'); // Afficher les détails d'un document spécifique
Route::get('/documents/{id}/edit', [TempController::class, 'edit'])->name('documents.edit'); // Afficher le formulaire de modification
Route::put('/documents/{id}', [TempController::class, 'update'])->name('documents.update'); // Mettre à jour un document spécifique
Route::delete('/documents/{id}', [TempController::class, 'destroy'])->name('documents.destroy'); // Supprimer un document spécifique