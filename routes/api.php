<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\GenreController;
use App\Http\Controllers\Api\MangaController;
use App\Http\Controllers\Api\ReadingListController;

// =========================
// READING LIST
// =========================

Route::get('/reading-list', [ReadingListController::class, 'index']);

Route::get(
    '/reading-list/manga/{manga_id}',
    [ReadingListController::class, 'byManga']
);

Route::post('/reading-list', [ReadingListController::class, 'create']);

Route::get('/reading-list/{id}', [ReadingListController::class, 'detail']);

Route::put('/reading-list/{id}', [ReadingListController::class, 'update']);

Route::delete('/reading-list/{id}', [ReadingListController::class, 'delete']);


// =========================
// LOGIN
// =========================

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {

    // =========================
    // AUTH
    // =========================

    Route::get('/me', [AuthController::class, 'me']);

    Route::get('/refresh', [AuthController::class, 'refresh']);

    Route::post('/logout', [AuthController::class, 'logout']);

    // =========================
    // GENRE
    // =========================

    Route::get('/genre', [GenreController::class, 'index']);

    Route::post('/genre', [GenreController::class, 'create']);

    Route::get('/genre/{id}', [GenreController::class, 'detail']);

    Route::put('/genre/{id}', [GenreController::class, 'update']);

    Route::patch('/genre/{id}', [GenreController::class, 'patch']);

    Route::delete('/genre/{id}', [GenreController::class, 'delete']);

    // =========================
    // MANGA
    // =========================

    Route::get('/manga', [MangaController::class, 'index']);

    Route::get(
        '/manga/genre/{genre_id}',
        [MangaController::class, 'byGenre']
    );

    Route::post('/manga', [MangaController::class, 'create']);

    Route::get('/manga/{id}', [MangaController::class, 'detail']);

    Route::put('/manga/{id}', [MangaController::class, 'update']);

    Route::delete('/manga/{id}', [MangaController::class, 'delete']);
});