<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\v1\{
    AuthController,
    MessageController,
    CustomerController,
    StaffController
};

Route::prefix('v1')->group(function () {
    Route::post('login', [AuthController::class, 'login']);

    Route::group(['middleware' => 'auth.jwt'], function () {
        Route::post('logout', [AuthController::class, 'logout']);

        Route::post('message', [MessageController::class, 'createMessage']);
        
        Route::get('messages', [CustomerController::class, 'chatHistory']);

        Route::get('message/all', [StaffController::class, 'allChatHistory']);
        Route::get('customer/all', [StaffController::class, 'allCustumers']);
        Route::delete('customer/{id}', [StaffController::class, 'deleteCustumer']);

        Route::post('reports', [CustomerController::class, 'createReport']);
    });
});