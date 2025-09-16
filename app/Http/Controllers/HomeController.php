<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use App\Models\Berita;
use App\Models\Album;
use App\Models\Document;

class HomeController extends Controller
{
    public function index()
    {
        $sliders = Slider::where('is_active', true)
                         ->orderBy('order', 'asc')
                         ->get();

        $beritaTerkini = Berita::where('status', 'publish')
                               ->latest()
                               ->take(4)
                               ->get();
        
        $albums = Album::withCount('photos')
                       ->latest()
                       ->take(4)
                       ->get();
        
        $dokumenTerbaru = Document::where('is_public', true)
                                   ->latest()
                                   ->take(6)
                                   ->get();
        
        return view('user-views.home', compact('sliders', 'beritaTerkini', 'albums', 'dokumenTerbaru'));
    }
}