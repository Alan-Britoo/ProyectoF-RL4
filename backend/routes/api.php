<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BitacoraController;

use App\Http\Controllers\PagesController;
use App\Http\Controllers\RollController;
use App\Http\Controllers\UsersController;

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

Route::resource('users', UsersController::class);
Route::put('users/{id}/status', [UsersController::class, 'c_statusU']);
Route::resource('rolls', RollController::class);
Route::put('rolls/{id}/status', [RollController::class, 'CstatusR']);
Route::resource('pages', PagesController::class);
Route::resource('bitacora', BitacoraController::class);


Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);
    Route::post('register', [AuthController::class, 'register']);
});
