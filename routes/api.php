<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    // membuat all route resource routes untuk PostController
    Route::apiResource('posts', PostController::class);
    Route::apiResource('posts.likes', LikeController::class);
    Route::apiResource('posts.comments', CommentController::class);
});
