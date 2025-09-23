<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AlbumController;
use App\Http\Controllers\Api\PhotoController;
use App\Http\Controllers\Api\TugasController;
use App\Http\Controllers\Api\AgendaController;
use App\Http\Controllers\Api\KontakController;
use App\Http\Controllers\Api\SliderController;
use App\Http\Controllers\Api\SejarahController;
use App\Http\Controllers\Api\DocumentController;
use App\Http\Controllers\Api\VisiMisiController;
use App\Http\Controllers\Api\OrganizationalStructureController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('visi-misi', [VisiMisiController::class, 'index']);
Route::get('visi-misi/{visiMisi}', [VisiMisiController::class, 'show']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('visi-misi', [VisiMisiController::class, 'store']);
    Route::put('visi-misi/{visiMisi}', [VisiMisiController::class, 'update']);
    Route::patch('visi-misi/{visiMisi}', [VisiMisiController::class, 'update']);
    Route::delete('visi-misi/{visiMisi}', [VisiMisiController::class, 'destroy']);
});

Route::post('/login', [AuthController::class, 'login']);

Route::get('/tugas', [TugasController::class, 'index']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/tugas', [TugasController::class, 'store']);
    Route::put('/tugas/{tuga}', [TugasController::class, 'update']);
    Route::delete('/tugas/{tuga}', [TugasController::class, 'destroy']);
});

Route::get('/sejarah', [SejarahController::class, 'index']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/sejarah', [SejarahController::class, 'store']);
    Route::put('/sejarah/{sejarah}', [SejarahController::class, 'update']);
    Route::delete('/sejarah/{sejarah}', [SejarahController::class, 'destroy']);
});

Route::get('struktur-organisasi', [OrganizationalStructureController::class, 'index']);
Route::get('struktur-organisasi/{organizationalStructure}', [OrganizationalStructureController::class, 'show']);
Route::middleware('auth:sanctum')->group(function() {
    Route::post('struktur-organisasi', [OrganizationalStructureController::class, 'store']);
    Route::post('struktur-organisasi/{organizationalStructure}', [OrganizationalStructureController::class, 'update']); // Menggunakan POST untuk update file
    Route::delete('struktur-organisasi/{organizationalStructure}', [OrganizationalStructureController::class, 'destroy']);
});

Route::get('/sliders', [SliderController::class, 'index']);
Route::get('/sliders/public', [SliderController::class, 'public']);
Route::get('/sliders/{slider}', [SliderController::class, 'show']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/sliders', [SliderController::class, 'store']);
    Route::post('/sliders/{slider}', [SliderController::class, 'update']); // Pakai POST untuk update file
    Route::delete('/sliders/{slider}', [SliderController::class, 'destroy']);
});

Route::get('/documents', [DocumentController::class, 'index']);
Route::get('/documents/{document}', [DocumentController::class, 'show']);
Route::get('/documents/{document}/download', [DocumentController::class, 'download']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/documents', [DocumentController::class, 'store']);
    Route::post('/documents/{document}', [DocumentController::class, 'update']); // Pakai POST untuk update file
    Route::delete('/documents/{document}', [DocumentController::class, 'destroy']);
});

Route::get('/albums', [AlbumController::class, 'index']);
Route::get('/albums/{album}', [AlbumController::class, 'show']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/albums', [AlbumController::class, 'store']);
    Route::post('/albums/{album}', [AlbumController::class, 'update']);
    Route::delete('/albums/{album}', [AlbumController::class, 'destroy']);
});

Route::get('/photos/{photo}', [PhotoController::class, 'show']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/albums/{album}/photos', [PhotoController::class, 'store']);
    Route::put('/photos/{photo}', [PhotoController::class, 'update']);
    Route::delete('/photos/{photo}', [PhotoController::class, 'destroy']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('kontak', KontakController::class)
         ->except(['store', 'update']);
});

Route::get('/agenda', [AgendaController::class, 'index']);
Route::get('/agenda/{agenda}', [AgendaController::class, 'show']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/agenda', [AgendaController::class, 'store']);
    Route::put('/agenda/{agenda}', [AgendaController::class, 'update']);
    Route::delete('/agenda/{agenda}', [AgendaController::class, 'destroy']);
});