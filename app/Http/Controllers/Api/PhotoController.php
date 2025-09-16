<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PhotoController extends Controller
{
    /**
     * @OA\Post(
     * path="/api/albums/{albumId}/photos",
     * operationId="storePhoto",
     * tags={"Photo"},
     * summary="Upload foto baru ke dalam album",
     * security={{"bearerAuth":{}}},
     * @OA\Parameter(name="albumId", in="path", required=true, @OA\Schema(type="integer")),
     * @OA\RequestBody(
     * required=true,
     * @OA\MediaType(
     * mediaType="multipart/form-data",
     * @OA\Schema(
     * type="object",
     * required={"judul", "photo"},
     * @OA\Property(property="judul", type="string"),
     * @OA\Property(property="deskripsi", type="string"),
     * @OA\Property(property="photo", type="file", format="binary", description="Bisa upload multiple file dengan nama photo[]")
     * )
     * )
     * ),
     * @OA\Response(response=201, description="Berhasil diupload")
     * )
     */
    public function store(Request $request, Album $album)
    {
        $validator = Validator::make($request->all(), [
            'judul'   => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'photo'   => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        $path = $request->file('photo')->store('album-photos/' . $album->id, 'public');

        $photo = Photo::create([
            'album_id'  => $album->id,
            'judul'     => $request->judul,
            'deskripsi' => $request->deskripsi,
            'path'      => $path
        ]);
        
        $photo->photo_url = asset('storage/' . $photo->path);

        return response()->json(['success' => true, 'message' => 'Foto berhasil diupload.', 'data' => $photo], 201);
    }
    
    /**
     * @OA\Get(
     * path="/api/photos/{id}",
     * operationId="getPhotoById",
     * tags={"Photo"},
     * summary="Menampilkan detail satu foto",
     * @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     * @OA\Response(response=200, description="Operasi berhasil"),
     * @OA\Response(response=404, description="Data tidak ditemukan")
     * )
     */
    public function show(Photo $photo)
    {
        // Menambahkan URL lengkap ke properti path
        $photo->photo_url = asset('storage/' . $photo->path);
        return response()->json(['success' => true, 'data' => $photo]);
    }

    /**
     * @OA\Put(
     * path="/api/photos/{id}",
     * operationId="updatePhoto",
     * tags={"Photo"},
     * summary="Memperbarui detail (judul/deskripsi) foto",
     * security={{"bearerAuth":{}}},
     * @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     * @OA\RequestBody(
     * required=true,
     * @OA\JsonContent(
     * required={"judul"},
     * @OA\Property(property="judul", type="string"),
     * @OA\Property(property="deskripsi", type="string")
     * )
     * ),
     * @OA\Response(response=200, description="Berhasil diperbarui")
     * )
     */
    public function update(Request $request, Photo $photo)
    {
        $validator = Validator::make($request->all(), [
            'judul'   => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        $photo->update($validator->validated());
        
        // Menambahkan URL lengkap ke properti path
        $photo->photo_url = asset('storage/' . $photo->path);

        return response()->json(['success' => true, 'message' => 'Detail foto berhasil diperbarui.', 'data' => $photo]);
    }

    /**
     * @OA\Delete(
     * path="/api/photos/{id}",
     * operationId="deletePhoto",
     * tags={"Photo"},
     * summary="Menghapus sebuah foto",
     * security={{"bearerAuth":{}}},
     * @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     * @OA\Response(response=200, description="Berhasil dihapus")
     * )
     */
    public function destroy(Photo $photo)
    {
        Storage::disk('public')->delete($photo->path);
        $photo->delete();

        return response()->json(['success' => true, 'message' => 'Foto berhasil dihapus.']);
    }
}