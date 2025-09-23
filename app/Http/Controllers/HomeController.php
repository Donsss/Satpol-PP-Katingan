<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use App\Models\Berita;
use App\Models\Album;
use App\Models\Document;
use App\Models\Agenda;
use App\Models\OrganizationalStructure;
use Illuminate\Http\JsonResponse;

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
        
        $agendaHariIni = Agenda::whereDate('tanggal', today())
                               ->orderBy('waktu', 'asc')
                               ->get();
        
        $agendaBulanIni = Agenda::whereBetween('tanggal', [today()->addDay(), today()->endOfMonth()])
                                ->orderBy('tanggal', 'asc')
                                ->orderBy('waktu', 'asc')
                                ->get();

        $pimpinanGrouped = OrganizationalStructure::where('section', '<=', 3)
                                           ->orderBy('order', 'asc')
                                           ->get()
                                           ->groupBy('section');

        return view('user-views.home', compact(
            'sliders', 
            'beritaTerkini', 
            'albums', 
            'dokumenTerbaru', 
            'agendaHariIni', 
            'agendaBulanIni',
            'pimpinanGrouped'
        ));
    }

    public function getAgendasByMonth($year, $month): JsonResponse
    {
        $agendas = Agenda::whereYear('tanggal', $year)
                         ->whereMonth('tanggal', $month)
                         ->orderBy('tanggal', 'asc')
                         ->orderBy('waktu', 'asc')
                         ->get()
                         ->groupBy(function($item) {
                             return (int)$item->tanggal->format('d');
                         });

        return response()->json($agendas);
    }
}