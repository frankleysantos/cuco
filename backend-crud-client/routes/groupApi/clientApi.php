<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ClientController;

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth/client'
], function ($router) {
    Route::post('/store', [ClientController::class, 'store']);
    Route::post('/update', [ClientController::class, 'update']);
    Route::get('/delete/{id}', [ClientController::class, 'delete']); 
    Route::post('/show', [ClientController::class, 'show'])->name('api.client.show'); 
    Route::post('/fakeStore/{id?}', [ClientController::class, 'apiFakeStore'])->name('clients.fake'); 
});