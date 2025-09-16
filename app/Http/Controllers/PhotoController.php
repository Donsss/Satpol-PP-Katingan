<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PhotoController extends Controller
{
    public function create(Album $album)
    {
        return view('photos.create', [
            'pageTitle' => 'Tambah Foto',
            'album' => $album
        ]);
    }

    public function store(Request $request, Album $album)
    {
        $validated = $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:10240'
        ]);

        $file = $request->file('photo');
        $path = $file->store('album-photos/' . $album->id, 'public');

        $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $title = Str::of($originalName)->replace(['-', '_'], ' ')->title();

        Photo::create([
            'album_id' => $album->id,
            'judul' => $title,
            'deskripsi' => null,
            'path' => $path
        ]);

        return redirect()->route('admin.albums.show', $album->id)->with('success', 'Foto berhasil diupload!');
    }

    public function edit(Photo $photo)
    {
        return view('photos.edit', [
            'pageTitle' => 'Edit Foto',
            'photo' => $photo,
            'album' => $photo->album
        ]);
    }

    public function update(Request $request, Photo $photo)
    {
        $validated = $request->validate([
            'judul' => 'nullable|max:255',
            'deskripsi' => 'nullable'
        ]);

        $photo->update($validated);

        return redirect()->route('admin.albums.show', $photo->album_id)
            ->with('success', 'Foto berhasil diperbarui!');
    }

    public function destroy(Photo $photo)
    {
        Storage::disk('public')->delete($photo->path);
        $photo->delete();
        return back()->with('success', 'Foto berhasil dihapus!');
    }
}