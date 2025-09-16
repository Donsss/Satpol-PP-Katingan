<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class AlbumController extends Controller
{

    public function galeri()
    {
        $albums = Album::withCount('photos')
                    ->latest()
                    ->paginate(12);

        return view('user-views.albums', [
            'albums' => $albums,
            'pageTitle' => 'Semua Album'
        ]);
    }

    public function index()
    {
        $albums = Album::withCount('photos')->where('user_id', Auth::id())->latest()->paginate(6);
        return view('albums.index', [
            'pageTitle' => 'Dashboard Album',
            'albums' => $albums
        ]);
    }

    public function create()
    {
        return view('albums.create', ['pageTitle' => 'Buat Album Baru']);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|max:255',
            'deskripsi' => 'nullable',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120'
        ]);

        if ($request->hasFile('cover')) {
            $validated['cover'] = $request->file('cover')->store('album-covers', 'public');
        }

        $validated['user_id'] = Auth::id();

        Album::create($validated);

        return redirect()->route('admin.albums.index')->with('success', 'Album berhasil dibuat!');
    }

    public function show(Album $album)
    {
        
        $photos = $album->photos()->latest()->paginate(12);
        return view('albums.show', [
            'pageTitle' => $album->judul,
            'album' => $album,
            'photos' => $photos
        ]);
    }

    public function lihat(Album $album)
    {
        $photos = $album->photos()->latest()->paginate(16);
        
        return view('user-views.lihat-photo', [
            'album' => $album,
            'photos' => $photos,
            'pageTitle' => $album->judul
        ]);
    }

    public function edit(Album $album)
    {
        return view('albums.edit', [
            'pageTitle' => 'Edit Album',
            'album' => $album
        ]);
    }

    public function update(Request $request, Album $album)
    {
        $validated = $request->validate([
            'judul' => 'required|max:255',
            'deskripsi' => 'nullable',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120'
        ]);

        if ($request->hasFile('cover')) {
            // Hapus cover lama jika ada
            if ($album->cover) {
                Storage::disk('public')->delete($album->cover);
            }
            $validated['cover'] = $request->file('cover')->store('album-covers', 'public');
        }

        $album->update($validated);

        return redirect()->route('admin.albums.index')->with('success', 'Album berhasil diperbarui!');
    }

    public function destroy(Album $album)
    {
        if ($album->cover) {
            Storage::disk('public')->delete($album->cover);
        }
        
        $album->photos()->delete();
        
        $album->delete();

        return redirect()->route('admin.albums.index')->with('success', 'Album berhasil dihapus!');
    }

    public function home()
    {
        $albums = Album::withCount('photos')
                      ->latest()
                      ->take(4)
                      ->get();

        return view('user-views.home', [
            'albums' => $albums
        ]);
    }
}