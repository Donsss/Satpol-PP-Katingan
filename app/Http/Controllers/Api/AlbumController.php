<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AlbumController extends Controller
{
    /**
     * @OA\Get(
     * path="/api/albums",
     * operationId="getAlbums",
     * tags={"Album"},
     * summary="Menampilkan semua album dengan paginasi",
     * @OA\Response(response=200, description="Operasi berhasil")
     * )
     */
    public function index()
    {
        $albums = Album::withCount('photos')->latest()->paginate(12);
        $albums->getCollection()->transform(function ($album) {
            if ($album->cover) {
                $album->cover_url = asset('storage/' . $album->cover);
            }
            return $album;
        });

        return response()->json(['success' => true, 'data' => $albums]);
    }

    /**
     * @OA\Post(
     * path="/api/albums",
     * operationId="storeAlbum",
     * tags={"Album"},
     * summary="Membuat album baru",
     * security={{"bearerAuth":{}}},
     * @OA\RequestBody(
     * required=true,
     * @OA\MediaType(
     * mediaType="multipart/form-data",
     * @OA\Schema(
     * type="object",
     * required={"judul"},
     * @OA\Property(property="judul", type="string"),
     * @OA\Property(property="deskripsi", type="string"),
     * @OA\Property(property="cover", type="file", format="binary")
     * )
     * )
     * ),
     * @OA\Response(response=201, description="Berhasil dibuat"),
     * @OA\Response(response=422, description="Validasi gagal")
     * )
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required|max:255',
            'deskripsi' => 'nullable|string',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        $validated = $validator->validated();
        if ($request->hasFile('cover')) {
            $validated['cover'] = $request->file('cover')->store('album-covers', 'public');
        }
        $validated['user_id'] = Auth::id();

        $album = Album::create($validated);
        if ($album->cover) {
            $album->cover_url = asset('storage/' . $album->cover);
        }

        return response()->json(['success' => true, 'message' => 'Album berhasil dibuat.', 'data' => $album], 201);
    }

    /**
     * @OA\Get(
     * path="/api/albums/{id}",
     * operationId="getAlbumById",
     * tags={"Album"},
     * summary="Menampilkan detail album beserta foto-fotonya",
     * @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     * @OA\Response(response=200, description="Operasi berhasil"),
     * @OA\Response(response=404, description="Data tidak ditemukan")
     * )
     */
    public function show(Album $album)
    {
        // Load foto-foto di dalam album dengan paginasi
        $photos = $album->photos()->latest()->paginate(16);
        $photos->getCollection()->transform(function ($photo) {
            $photo->photo_url = asset('storage/' . $photo->path);
            return $photo;
        });

        if ($album->cover) {
            $album->cover_url = asset('storage/' . $album->cover);
        }
        
        $album->photos_paginated = $photos;

        return response()->json(['success' => true, 'data' => $album]);
    }

    /**
     * @OA\Post(
     * path="/api/albums/{id}",
     * operationId="updateAlbum",
     * tags={"Album"},
     * summary="Memperbarui album (gunakan POST dengan _method=PUT)",
     * security={{"bearerAuth":{}}},
     * @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     * @OA\RequestBody(
     * required=true,
     * @OA\MediaType(
     * mediaType="multipart/form-data",
     * @OA\Schema(
     * type="object",
     * required={"judul", "_method"},
     * @OA\Property(property="_method", type="string", example="PUT"),
     * @OA\Property(property="judul", type="string"),
     * @OA\Property(property="deskripsi", type="string"),
     * @OA\Property(property="cover", type="file", format="binary")
     * )
     * )
     * ),
     * @OA\Response(response=200, description="Berhasil diperbarui")
     * )
     */
    public function update(Request $request, Album $album)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required|max:255',
            'deskripsi' => 'nullable|string',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        $validated = $validator->validated();
        if ($request->hasFile('cover')) {
            if ($album->cover) {
                Storage::disk('public')->delete($album->cover);
            }
            $validated['cover'] = $request->file('cover')->store('album-covers', 'public');
        }

        $album->update($validated);
        if ($album->cover) {
            $album->cover_url = asset('storage/' . $album->cover);
        }

        return response()->json(['success' => true, 'message' => 'Album berhasil diperbarui.', 'data' => $album]);
    }

    /**
     * @OA\Delete(
     * path="/api/albums/{id}",
     * operationId="deleteAlbum",
     * tags={"Album"},
     * summary="Menghapus album dan semua fotonya",
     * security={{"bearerAuth":{}}},
     * @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     * @OA\Response(response=200, description="Berhasil dihapus")
     * )
     */
    public function destroy(Album $album)
    {
        if ($album->cover) {
            Storage::disk('public')->delete($album->cover);
        }
        
        foreach ($album->photos as $photo) {
            Storage::disk('public')->delete($photo->path);
            $photo->delete();
        }

        $album->delete();

        return response()->json(['success' => true, 'message' => 'Album berhasil dihapus.']);
    }
}