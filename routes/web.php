<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\LogbookController;
use App\Http\Controllers\QrController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('Home/landing');
});

Route::get('/clients',[ClientController::class, 'index']);
Route::get('/clients/pdf', [ClientController::class, 'pdf']);
Route::get('/clients/csv', [ClientController::class, 'generateCSV']);
Route::post('/clients/import-csv', [ClientController::class, 'importCSV'])->name('clients.import-csv');
Route::get('/clients/create',[ClientController::class, 'create']);
Route::post('/clients/create',[ClientController::class, 'store']);
Route::get('/clients/{client}',[ClientController::class, 'edit']);
Route::post('/clients/{client}',[ClientController::class, 'update']);
Route::delete('/clients/delete/{client}',[ClientController::class, 'delete']);

Route::get('/logbooks', [LogbookController::class, 'index']);
Route::get('/logbooks/create', [LogbookController::class, 'create']);
Route::get('/logbooks/pdf', [LogbookController::class, 'pdf']);
Route::post('/logbooks/import-csv', [LogbookController::class, 'importCSV'])->name('logbooks.import-csv');
Route::post('/logbooks', [LogbookController::class, 'store']);
Route::post('/logbooks/scan', [LogbookController::class, 'scan'])->name('logbooks.scan');
Route::get('/logbooks/{id}/edit', [LogbookController::class, 'edit']);
Route::put('/logbooks/{id}', [LogbookController::class, 'update']);
Route::delete('/logbooks/delete/{id}', [LogbookController::class, 'destroy']);
Route::get('/logbooks/csv', [LogbookController::class, 'generateCSV']);



