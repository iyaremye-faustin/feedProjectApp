<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProvinceController;
use App\Http\Controllers\SectorController;
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


Route::resource('/province', ProvinceController::class);
Route::resource('/sector', SectorController::class);

Route::post('/user',[\App\Http\Controllers\Auth\UserRegisterController::class,'userRegister']);
Route::resource('roles', '\App\Http\Controllers\RoleController');

