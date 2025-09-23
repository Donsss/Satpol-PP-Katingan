<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\TugasController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SejarahController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\VisiMisiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\admin\BeritaController;
use App\Http\Controllers\OrganizationalStructureController;
use App\Http\Controllers\User\BeritaController as UserBeritaController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/documents/download/{document}', [DocumentController::class, 'downloadUser'])->name('documents.user.download');

Route::prefix('berita')->name('berita.user.')->group(function (): void {
    Route::get('/', [UserBeritaController::class, 'index'])->name('index');
    Route::get('/{beritas}/{slug}', [UserBeritaController::class, 'show'])->name('show');
});

Route::prefix('galeri')->name('galeri.user.')->group(function (): void {
    Route::get('/', [AlbumController::class, 'galeri'])->name('galeri');
    Route::get('/{album}', [AlbumController::class, 'lihat'])->name('lihat');
});

Route::prefix('dokumen')->name('dokumen.user.')->group(function (): void {
    Route::get('/', [DocumentController::class, 'indexUser'])->name('indexUser');
    Route::get('/{document}', [DocumentController::class, 'showUser'])->name('showUser');
    Route::post('/{document}/download', [DocumentController::class, 'downloadUser'])->name('downloadUser');
});

Route::prefix('struktur-organisasi')->name('struktur-organisasi.user.')->group(function (): void {
    Route::get('/', [OrganizationalStructureController::class, 'showForUser'])->name('struktur-organisasi');
});

Route::prefix('visi-misi')->name('visi-misi.user.')->group(function (): void {
    Route::get('/', [VisiMisiController::class, 'showUser'])->name('showUser');
});

Route::prefix('sejarah')->name('sejarah.user.')->group(function (): void {
    Route::get('/', [SejarahController::class, 'showUser'])->name('showUser');
});

Route::prefix('tugas-fungsi')->name('tugas-fungsi.user.')->group(function (): void {
    Route::get('/', [TugasController::class, 'showUser'])->name('showUser');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    
    Route::middleware(['role:super-admin|admin'])->prefix('berita')->name('berita.')->group(function () {
        Route::get('/', [BeritaController::class, 'index'])->name('index');
        Route::get('/create', [BeritaController::class, 'create'])->name('create');
        Route::post('/', [BeritaController::class, 'store'])->name('store');
        Route::get('/{berita}', [BeritaController::class, 'show'])->name('show');
        Route::get('/{beritum}/edit', [BeritaController::class, 'edit'])->name('edit');
        Route::put('/{beritum}', [BeritaController::class, 'update'])->name('update');
        Route::delete('/{beritum}', [BeritaController::class, 'destroy'])->name('destroy');
    });

    Route::middleware(['role:super-admin'])->prefix('albums')->group(function () {
        Route::get('/', [AlbumController::class, 'index'])->name('albums.index');
        Route::get('/create', [AlbumController::class, 'create'])->name('albums.create');
        Route::post('/', [AlbumController::class, 'store'])->name('albums.store');
        Route::get('/{album}', [AlbumController::class, 'show'])->name('albums.show');
        Route::get('/albums/{album}/edit', [AlbumController::class, 'edit'])->name('albums.edit');
        Route::put('/albums/{album}', [AlbumController::class, 'update'])->name('albums.update');
        Route::delete('/albums/{album}', [AlbumController::class, 'destroy'])->name('albums.destroy');
        });

    Route::prefix('documents')->group(function () {
        Route::get('/', [DocumentController::class, 'index'])->name('documents.index');
        Route::get('/create', [DocumentController::class, 'create'])->name('documents.create');
        Route::post('/', [DocumentController::class, 'store'])->name('documents.store');
        Route::get('/{document}', [DocumentController::class, 'show'])->name('documents.show');
        Route::POST('/{document}/download', [DocumentController::class, 'downloadAdmin'])->name('documents.download');
        Route::get('/{document}/edit', [DocumentController::class, 'edit'])->name('documents.edit');
        Route::put('/{document}', [DocumentController::class, 'update'])->name('documents.update');
        Route::delete('/{document}', [DocumentController::class, 'destroy'])->name('documents.destroy');
    });

    Route::prefix('organisasi')->name('organisasi.')->group(function () {
        Route::get('/', [OrganizationalStructureController::class, 'index'])->name('index');
        Route::get('/create', [OrganizationalStructureController::class, 'create'])->name('create');
        Route::post('/', [OrganizationalStructureController::class, 'store'])->name('store');
        Route::get('/{organizationalStructure}/edit', [OrganizationalStructureController::class, 'edit'])->name('edit');
        Route::put('/{organizationalStructure}', [OrganizationalStructureController::class, 'update'])->name('update');
        Route::delete('/{organizationalStructure}', [OrganizationalStructureController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('sliders')->name('sliders.')->group(function () {
        Route::get('/', [SliderController::class, 'index'])->name('index');
        Route::get('/create', [SliderController::class, 'create'])->name('create');
        Route::post('/', [SliderController::class, 'store'])->name('store');
        Route::get('/{slider}/edit', [SliderController::class, 'edit'])->name('edit');
        Route::put('/{slider}', [SliderController::class, 'update'])->name('update');
        Route::delete('/{slider}', [SliderController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('visi-misi')->name('visi-misi.')->group(function () {
        Route::get('/', [VisiMisiController::class, 'index'])->name('index');
        Route::get('/create', [VisiMisiController::class, 'create'])->name('create');
        Route::post('/', [VisiMisiController::class, 'store'])->name('store');
        Route::get('/{visiMisi}/edit', [VisiMisiController::class, 'edit'])->name('edit');
        Route::put('/{visiMisi}', [VisiMisiController::class, 'update'])->name('update');
        Route::delete('/{visiMisi}', [VisiMisiController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('sejarah')->name('sejarah.')->group(function () {
        Route::get('/', [SejarahController::class, 'index'])->name('index');
        Route::get('/create', [SejarahController::class, 'create'])->name('create');
        Route::post('/', [SejarahController::class, 'store'])->name('store');
        Route::get('/{sejarah}/edit', [SejarahController::class, 'edit'])->name('edit');
        Route::put('/{sejarah}', [SejarahController::class, 'update'])->name('update');
        Route::delete('/{sejarah}', [SejarahController::class, 'destroy'])->name('destroy');
    });

    Route::resource('tugas', TugasController::class)->parameters(['tugas' => 'tuga']);

    Route::middleware(['role:super-admin'])->group(function () {
        Route::resource('users', UserController::class);
    });

    Route::middleware(['role:super-admin|admin'])->prefix('kontak')->name('kontak.')->group(function () {
        Route::get('/', [App\Http\Controllers\KontakController::class, 'indexAdmin'])->name('index');
        Route::get('/{kontak}', [App\Http\Controllers\KontakController::class, 'showAdmin'])->name('show');
        Route::delete('/{kontak}', [App\Http\Controllers\KontakController::class, 'destroyAdmin'])->name('destroy');
    });

    Route::middleware(['role:super-admin|admin'])->group(function () {
        Route::resource('agenda', AgendaController::class);
    });
});

Route::get('/api/agendas/{year}/{month}', [HomeController::class, 'getAgendasByMonth'])->name('agendas.api');

Route::get('/kontak', [KontakController::class, 'create'])->name('kontak.create');
Route::post('/kontak', [KontakController::class, 'store'])->name('kontak.store');

require __DIR__.'/auth.php';

Route::middleware('auth')->group(function () {
    Route::get('/albums/{album}/photos/create', [PhotoController::class, 'create'])->name('photos.create');
    Route::post('/albums/{album}/photos', [PhotoController::class, 'store'])->name('photos.store');
    Route::get('/photos/{photo}/edit', [PhotoController::class, 'edit'])->name('photos.edit');
    Route::put('/photos/{photo}', [PhotoController::class, 'update'])->name('photos.update');
    Route::delete('/photos/{photo}', [PhotoController::class, 'destroy'])->name('photos.destroy');
    Route::get('/photos/{photo}/full', [PhotoController::class, 'showFull'])->name('photos.showFull');
});

