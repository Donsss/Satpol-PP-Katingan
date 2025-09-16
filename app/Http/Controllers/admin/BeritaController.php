<?php

namespace App\Http\Controllers\admin;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BeritaController extends Controller
{
    public function index()
    {
        $berita = Berita::latest()->paginate(9);
        return view('berita.index', [
            'pageTitle' => 'Dashboard Berita',
            'berita' => $berita
        ]);
    }

    public function create()
    {
        return view('berita.create', ['pageTitle' => 'Tambah Berita Baru']);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|max:255',
            'berita' => 'required',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:draft,archive,publish'
        ]);

        // Simpan file thumbnail
        $validated['thumbnail'] = $request->file('thumbnail')->store('berita-thumbnails', 'public');
        $validated['id_user'] = Auth::id();

        Berita::create($validated);

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil ditambahkan!');
    }

    public function edit(Berita $beritum)
    {
        return view('berita.edit', [
            'pageTitle' => 'Edit Berita',
            'berita' => $beritum
        ]);
    }

    public function update(Request $request, Berita $beritum)
    {
        $validated = $request->validate([
            'judul' => 'required|max:255',
            'berita' => 'required',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:draft,archive,publish'
        ]);

        if ($request->hasFile('thumbnail')) {
            // Hapus thumbnail lama jika ada
            if ($beritum->thumbnail) {
                Storage::disk('public')->delete($beritum->thumbnail);
            }
            $validated['thumbnail'] = $request->file('thumbnail')->store('berita-thumbnails', 'public');
        }

        $beritum->update($validated);

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil diperbarui!');
    }

    public function destroy(Berita $beritum)
    {
        if ($beritum->thumbnail) {
            Storage::disk('public')->delete($beritum->thumbnail);
        }
        
        $beritum->delete();
        
        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil dihapus!');
    }

    public function show(Berita $berita)
    {
        return view('berita.show', [
            'pageTitle' => $berita->judul,
            'berita' => $berita
        ]);
    }

    
}