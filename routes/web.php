<?php

use App\Http\Controllers\DataController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DataController::class, 'overview'])->name('overview');
Route::get('/dashboard', [DataController::class, 'dashboard'])->name('dashboard');
Route::get('/add-data', [DataController::class, 'addData'])->name('add_data');
Route::get('/edit-data/{id}', [DataController::class, 'editData'])->name('edit_data');

Route::delete('/delete-data/{id}', [DataController::class, 'deleteData'])->name('delete_data');
Route::post('/send-data', [DataController::class, 'sendData'])->name('send_data');
Route::put('/update-data/{id}', [DataController::class, 'updateData'])->name('update_data');