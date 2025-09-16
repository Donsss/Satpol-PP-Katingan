<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function index(Request $request)
    {
        $query = Berita::with('user')
                    ->where('status', Berita::STATUS_PUBLISH)
                    ->orderBy('created_at', 'desc');

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('judul', 'like', '%'.$search.'%')->orWhere('berita', 'like', '%'.$search.'%');
            });
        }

        $berita = $query->paginate(6);

        return view('user-views.berita', [
            'pageTitle' => 'Berita Terkini',
            'berita' => $berita,
            'searchQuery' => $request->input('search', '')
        ]);
    }

    public function show(Berita $beritas, $slug = null)
    {
        if ($beritas->status !== Berita::STATUS_PUBLISH) {
            abort(404);
        }
        
        if ($slug !== $beritas->slug) {
            return redirect()->route('berita.user.show', [$beritas->id, $beritas->slug], 301);
        }

        $beritas->increment('views');
        
        $rekomendasiBerita = Berita::where('id', '!=', $beritas->id)
                                    ->where('status', Berita::STATUS_PUBLISH)
                                    ->orderBy('views', 'desc')
                                    ->take(3)
                                    ->get();

        return view('user-views.lihat-berita', [
            'berita' => $beritas,
            'rekomendasiBerita' => $rekomendasiBerita,
            'pageTitle' => $beritas->judul
        ]);
    }
}