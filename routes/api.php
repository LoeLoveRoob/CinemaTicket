<?php

use App\Http\Controllers\Api\v1\ArtistController;
use App\Http\Controllers\Api\v1\Auth\AuthController;
use App\Http\Controllers\Api\v1\CategoryController;
use App\Http\Controllers\Api\v1\CinemaController;
use App\Http\Controllers\Api\v1\DirectorController;
use App\Http\Controllers\Api\v1\GenreController;
use App\Http\Controllers\Api\v1\MovieController;
use App\Http\Controllers\Api\v1\RoleController;
use App\Http\Controllers\Api\v1\UserController;
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
Route::group(["prefix"=> "home"], function (){
    Route::post("send-otp", [AuthController::class, "sendOtp"]);
    Route::post("confirm-otp", [AuthController::class, "confirmOtp"]);
    Route::post("register", [AuthController::class, "register"])->name("register");
    Route::post("login", [AuthController::class, "login"])->name("login");
    Route::delete("logout", [AuthController::class, "logout"]);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware("auth:sanctum")->group(function (){
    Route::apiResource("user", UserController::class);
    Route::apiResource("role", RoleController::class);
    Route::apiResource("category", CategoryController::class);
    Route::apiResource("cinema", CinemaController::class);
    Route::apiResource("genre", GenreController::class);
    Route::apiResource("movie", MovieController::class);
});
