<?php
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

Route::middleware(['auth:sanctum', 'IsAdmin'])->post('/users',[\App\Http\Controllers\Auth\UserRegisterController::class,'userRegister']);
Route::middleware(['auth:sanctum', 'IsAdmin'])->get('/users',[\App\Http\Controllers\UserController::class,'users']);
Route::middleware(['auth:sanctum', 'IsAdmin'])->resource('roles', '\App\Http\Controllers\RoleController');
Route::post("/login",[\App\Http\Controllers\UserController::class,'login']);
Route::middleware('auth:sanctum')->post('/logout',[\App\Http\Controllers\UserController::class,'logout']);
Route::middleware(['auth:sanctum', 'IsAdmin'])->resource('/provinces', '\App\Http\Controllers\ProvinceController');
Route::middleware(['auth:sanctum', 'IsAdmin'])->resource('/sectors', '\App\Http\Controllers\SectorController');
Route::middleware(['auth:sanctum', 'IsAdmin'])->resource('/seasons', '\App\Http\Controllers\SeasonController');
Route::middleware(['auth:sanctum', 'IsAdmin'])->resource('/districts', '\App\Http\Controllers\DistrictController');
