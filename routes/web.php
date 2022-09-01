<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

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

Route::get("/", function () {
    return response()->json(["message" => "Welcome to FeedApp Application"]);
});

//Clear Cache facade value:
Route::get("/clear/cache", function () {
    $exitCode = Artisan::call("cache:clear");
    return "<h1>Cache values cleared</h1>";
});

//Reoptimized class loader:
Route::get("/optimize", function () {
    Artisan::call("optimize");
    return "<h1>Optimized</h1>";
});

Route::get("/refresh", function () {
    $exitCode = Artisan::call("cache:clear");
    $exitCode = Artisan::call("view:clear");
    $exitCode = Artisan::call("route:clear");
    $exitCode = Artisan::call("clear-compiled");
    $exitCode = Artisan::call("config:cache");

    return "<h1>Caches cleared</h1>";
});

Route::get("/migrate", function () {
    $code = Artisan::call("migrate", [
        "--force" => true,
    ]);
    return "<h1>Migrated</h1>";
});
Route::get("/migrate/fresh", function () {
    $code = Artisan::call("migrate:fresh", [
        "--force" => true,
    ]);
    return "<h1>Migrated</h1>";
});
Route::get("/keygenerate", function () {
    $code = Artisan::call("key:generate", [
        "--force" => true,
    ]);
    return "<h1>Key generated</h1>";
});

Route::get("/dbseed", function () {
    $code = Artisan::call("db:seed", [
        "--force" => true,
    ]);
    return "<h1>Seeded</h1>";
});
