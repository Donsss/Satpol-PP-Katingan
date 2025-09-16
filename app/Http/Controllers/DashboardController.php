<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Berita;
use App\Models\Document;
use Illuminate\Http\Request;
use App\Models\ActivityLog;

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman dashboard dengan data statistik.
     */
    public function index()
    {

        $jumlahBerita = Berita::count();

        $jumlahAlbum = Album::count();

        $jumlahDokumen = Document::count();

        $activityLogs = ActivityLog::with('user')->latest()->take(10)->get();

        return view('dashboard', [
            'jumlahBerita' => $jumlahBerita,
            'jumlahAlbum' => $jumlahAlbum,
            'jumlahDokumen' => $jumlahDokumen,
            'activityLogs' => $activityLogs
        ]);
    }
}
