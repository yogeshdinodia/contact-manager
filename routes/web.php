<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

Route::get('/', [ContactController::class, 'index'])->name('contacts.index');
Route::get('/contacts/create', [ContactController::class, 'create'])->name('contacts.create');
Route::post('/contacts', [ContactController::class, 'store'])->name('contacts.store');
Route::get('/contacts/{contact}/edit', [ContactController::class, 'edit'])->name('contacts.edit');
Route::put('/contacts/{contact}', [ContactController::class, 'update'])->name('contacts.update');
Route::delete('/contacts/{contact}', [ContactController::class, 'destroy'])->name('contacts.destroy');

// Bulk import Contacts
Route::post('/contacts/import-xml', [ContactController::class, 'importXML'])->name('contacts.importXML');

// Trashed Contacts
Route::get('/contacts/trashed', [ContactController::class, 'trashed'])->name('contacts.trashed');
Route::post('/contacts/restore/{id}', [ContactController::class, 'restore'])->name('contacts.restore');
Route::delete('/contacts/force-delete/{id}', [ContactController::class, 'forceDelete'])->name('contacts.forceDelete');