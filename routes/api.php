<?php

use App\Http\Controllers\API\ApiPostController;
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

Route::prefix('posts')->group(function () {
 Route::get('/',[ApiPostController::class, 'index']);
    Route::post('/',[ApiPostController::class, 'store']);
    Route::get('/{id}',[ApiPostController::class, 'show']);
    Route::put('/{id}',[ApiPostController::class, 'update']);
    Route::delete('/{id}',[ApiPostController::class, 'destroy']);
});
