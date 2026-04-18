<?php

use App\Http\Controllers\Api\ContentSyncController;
use Illuminate\Support\Facades\Route;

Route::prefix('content')->group(function () {
    Route::get('/about', [ContentSyncController::class, 'about']);
    Route::get('/sync', [ContentSyncController::class, 'sync']);
    Route::get('/programs', [ContentSyncController::class, 'programs']);
    Route::get('/focus-areas', [ContentSyncController::class, 'focusAreas']);
    Route::get('/gallery', [ContentSyncController::class, 'gallery']);
    Route::get('/partners', [ContentSyncController::class, 'partners']);
    Route::get('/faqs', [ContentSyncController::class, 'faqs']);
    Route::get('/get-involved', [ContentSyncController::class, 'getInvolved']);
});
