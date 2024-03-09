<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\UploadImageController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardItemController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);
    Route::post('profile', [ProfileController::class, 'getProfileData']);
});

Route::group([

    'middleware' => 'api',

], function ($router) {

    Route::post('registration', [RegistrationController::class, 'addUser']);
    Route::post('upload', [UploadImageController::class, 'save']);
});

Route::group([

    'middleware' => 'api',
    'prefix' => 'dashboard'

], function ($router) {
    // Основные таски (статус)
    Route::post('create-status', [DashboardController::class, 'createStatus']);
    Route::post('read-status', [DashboardController::class, 'readStatus']);
    Route::put('update-status/{id}', [DashboardController::class, 'updateStatus']);
    Route::delete('delete-status/{id}', [DashboardController::class, 'deleteStatus']);
    // Вложенные таски
    Route::post('create', [DashboardItemController::class, 'createTask']);
    Route::post('read/{id}', [DashboardItemController::class, 'readTasks']);
    Route::put('update/{id}', [DashboardItemController::class, 'updateTask']);
    Route::delete('delete/{id}', [DashboardItemController::class, 'deleteTask']);
});
