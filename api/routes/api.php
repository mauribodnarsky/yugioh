<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ApiCardController;
use App\Http\Controllers\TypeCardController;

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
Route::post('user/register', [AuthController::class, 'register']);
Route::post('user/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::post('/refresh', [AuthController::class, 'refresh'])->middleware('auth:sanctum');
Route::get('/user', [AuthController::class, 'user'])->middleware('auth:sanctum');
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//RUTAS DE CARTAS
Route::prefix('cards')->middleware('auth:sanctum')->group(function(){
    Route::get('/', [ApiCardController::class, 'index']);
    Route::post('search', [ApiCardController::class, 'search']);

    Route::post('/', [ApiCardController::class, 'create']);
    Route::post('/update', [ApiCardController::class, 'update']);
    Route::delete('/delete/{id}',[ApiCardController::class,'destroy']);
    
    });

    //RUTAS DE CARTAS
Route::prefix('type_cards')->middleware('auth:sanctum')->group(function(){
    Route::get('/', [TypeCardController::class, 'index']);
    Route::get('/{id}', [TypeCardController::class, 'getOne']);
    Route::post('/', [TypeCardController::class, 'create']);
    Route::put('/{id}', [TypeCardController::class, 'update']);
    Route::delete('/{id}',[TypeCardController::class,'destroy']);
    
    });
