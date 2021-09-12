<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
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

Route::get('/getusers/', [UsersController::class, 'getUsers']);
Route::post('/addusers/', [UsersController::class, 'addUsers']);
Route::put('/updateusers/', [UsersController::class, 'updateUsers']);
Route::delete('/delete/', [UsersController::class, 'delete']);
Route::post('/register/', [UsersController::class, 'register']);
Route::post('/auth/', [UsersController::class, 'auth']);
Route::post('/proverka/', [UsersController::class, 'proverka'])->middleware("Mid");
