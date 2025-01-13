<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\FarmerController;
use App\Http\Controllers\Api\V1\TransactionsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/




Route::group(['prefix' => 'v1'], function(){
    Route::apiResource('farmers', FarmerController::class);
    Route::apiResource('transactions', TransactionsController::class);
});