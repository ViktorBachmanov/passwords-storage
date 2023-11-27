<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PasswordController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\TreeController;
use App\Http\Controllers\UserController;
use App\Models\User;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


const PREFIX = 'pw-storage';

Route::get(PREFIX, function () {
  return view('passwords-storage');
})->middleware('auth');

Route::get(PREFIX . '/users', function () {
  return User::all()->map(fn ($user) => [
    'label' => $user->email,
    'value' => $user->email,
  ]);
});

Route::get('/login', function () {
  return view('login');
})->name('login');


Route::middleware(['auth'])->group(function () {
  Route::prefix(PREFIX)->group(function () { 
    Route::post('/passwords', [PasswordController::class, 'store']);
    Route::post('/groups', [GroupController::class, 'store']);
    Route::get('/tree', [TreeController::class, 'index']);  
    Route::patch('/toggle-access', [UserController::class, 'toggleAccess']);
  });
});