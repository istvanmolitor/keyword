<?php

use Illuminate\Support\Facades\Route;
use Molitor\Keyword\Http\Controllers\Api\KeywordApiController;

Route::prefix('admin/keyword')
    ->middleware(['api', 'auth:sanctum', 'permission:keyword'])
    ->name('keyword.')
    ->group(function () {
        Route::resource('keywords', KeywordApiController::class);
    });
