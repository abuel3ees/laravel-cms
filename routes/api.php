<?php

use App\Http\Controllers\Api\ArticleApiController;

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('articles', ArticleApiController::class);
    Route::put('articles/{id}/publish', [ArticleApiController::class, 'publish']);
});
