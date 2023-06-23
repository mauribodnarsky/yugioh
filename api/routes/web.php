<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\TypeCardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::post('/refresh', [AuthController::class, 'refresh'])->middleware('auth:sanctum');
Route::get('/user', [AuthController::class, 'user'])->middleware('auth:sanctum');
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//RUTAS DE CARTAS
Route::prefix('public/cards')->middleware('auth:sanctum')->group(function(){
    Route::get('/', [CardController::class, 'index']);
    Route::post('search', [CardController::class, 'search']);

    Route::post('/', [CardController::class, 'create'])->name('crear_carta');
    Route::post('/update', [CardController::class, 'update'])->name('editar_carta');
    Route::post('/delete',[CardController::class,'destroy'])->name('borrar_carta');
    
    });

    //RUTAS DE CARTAS
Route::prefix('type_cards')->middleware('auth:sanctum')->group(function(){
    Route::get('/', [TypeCardController::class, 'index']);
    Route::get('/{id}', [TypeCardController::class, 'getOne']);
    Route::post('/', [TypeCardController::class, 'create']);
    Route::put('/{id}', [TypeCardController::class, 'update']);
    Route::delete('/{id}',[TypeCardController::class,'destroy']);
    
    });
Route::get('/', function () {
    return view('auth.login');
});
