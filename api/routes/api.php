<?php

use App\Http\Controllers\UsersControllers;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;

Route::get('/products', [ProductsController::class, 'index']);

Route::post('/products', [ProductsController::class, 'store'])
    ->middleware('auth:sanctum');

Route::patch('/products/{id}', [ProductsController::class, 'update'])
    ->middleware('auth:sanctum');

Route::delete('/products/{id}', [ProductsController::class, 'destroy'])
    ->middleware('auth:sanctum');

Route::post('/users/login', [UsersControllers::class, 'login']);

Route::get('/users', [UsersControllers::class, 'index'])
    ->middleware('auth:sanctum');
