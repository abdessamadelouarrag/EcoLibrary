<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use Illuminate\Container\Attributes\Auth;
use App\Http\Controllers\Api\CategorieController;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\AdminStatsController;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/signup', [AuthController::class, 'signup']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function(){
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::middleware(['auth:sanctum', 'admin'])->group(function () {
    Route::apiResource('categorie', CategorieController::class);
    Route::apiResource('books', BookController::class);
    Route::get('admin/statistics', [AdminStatsController::class, 'index']);
});