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

Route::post('/users',[\App\Http\Controllers\Auth\UserRegisterController::class,'userRegister']);
Route::get('/users',[\App\Http\Controllers\UserController::class,'users']);
Route::resource('roles', '\App\Http\Controllers\RoleController');
Route::post("/login",[\App\Http\Controllers\UserController::class,'login']);
Route::middleware('auth:sanctum')->post('/logout',[\App\Http\Controllers\UserController::class,'logout']);
Route::resource('/provinces', '\App\Http\Controllers\ProvinceController');
Route::resource('/sectors', '\App\Http\Controllers\SectorController');
