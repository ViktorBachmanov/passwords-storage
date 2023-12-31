<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ItemController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\TreeController;
use App\Http\Controllers\UserController;
use App\Models\User;

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


// const PREFIX = 'pw-storage';

Route::middleware(['auth:sanctum'])->group(function () {
  Route::prefix('pw-storage')->group(function () { 
    Route::get('/users', [UserController::class, 'index'])->withoutMiddleware('auth:sanctum');
    Route::get('/passwords/{password}', [PasswordController::class, 'show']);
    Route::post('/{items}', [ItemController::class, 'store']);
    Route::get('/tree', [TreeController::class, 'index']);  
    Route::patch('/{itemClassName}/{itemId}', [ItemController::class, 'update']);
  });
});

// Route::get(PREFIX . '/users', [UserController::class, 'index']);