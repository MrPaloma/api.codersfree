<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\Auth\LoginController;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// endPoint que usarn los clientes para loguearse
Route::post('login', [LoginController::class, 'store']);

Route::post('register', [RegisterController::class, 'store'])->name('api.v1.register');

Route::apiResource('categories', CategoryController::class)->names('api.v1.categories');
Route::apiResource('posts', PostController::class)->names('api.v1.posts');