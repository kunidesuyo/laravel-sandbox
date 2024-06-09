<?php

use App\Http\Controllers\AwsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return [
        'message' => 'ok',
    ];
});

Route::prefix('aws')->group(function () {
    Route::get('/test', [AwsController::class, 'test']);
    Route::post('/signup', [AwsController::class, 'signup']);
});
