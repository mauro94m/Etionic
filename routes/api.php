<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/registro', [App\Http\Controllers\AuthController::class, 'registro']);
Route::post('/login', [App\Http\Controllers\AuthController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout']);
    Route::get('/favorito', [App\Http\Controllers\FavoritoController::class, 'index']);
    Route::post('/favorito', [App\Http\Controllers\FavoritoController::class, 'store']);
    Route::delete('/favorito/{favorito}', [App\Http\Controllers\FavoritoController::class, 'destroy']);
    Route::get('/unreadnotifications', [App\Http\Controllers\FavoritoController::class, 'unreadnotifications']);
});