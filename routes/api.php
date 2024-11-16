<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});





Route::get('/mangas', [\App\Http\Controllers\API\MangasAdminController::class, 'index'])
    ->middleware(['auth']);

Route::get('/mangas/{id}', [\App\Http\Controllers\API\MangasAdminController::class, 'view'])
    ->middleware(['auth']);
Route::post('/mangas', [\App\Http\Controllers\API\MangasAdminController::class, 'create'])
    ->middleware(['auth']);