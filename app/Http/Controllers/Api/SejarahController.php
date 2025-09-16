<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Sejarah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SejarahController extends Controller
{
    /**
     * @OA\Get(
     * path="/api/sejarah",
     * operationId="getSejarah",
     * tags={"Sejarah"},
     * summary="Menampilkan data Sejarah",
     * description="Mengambil data Sejarah yang tersimpan (hanya ada satu).",
     * @OA\Response(
     * response=200,
     * description="Operasi berhasil",
     * @OA\JsonContent(type="object", @OA\Property(property="data", type="object"))
     * ),
     * @OA\Response(response=404, description="Data tidak ditemukan")
     * )
     */
    public function index()
    {
        $sejarah = Sejarah::first();

        if (!$sejarah) {
            return response()->json(['success' => false, 'message' => 'Data Sejarah tidak ditemukan.'], 404);
        }

        return response()->json(['success' => true, 'data' => $sejarah]);
    }

    /**
     * @OA\Post(
     * path="/api/sejarah",
     * operationId="storeSejarah",
     * tags={"Sejarah"},
     * summary="Membuat data Sejarah baru",
     * description="Hanya bisa dijalankan jika belum ada data Sejarah sama sekali.",
     * security={{"bearerAuth":{}}},
     * @OA\RequestBody(
     * required=true,
     * @OA\JsonContent(required={"konten"}, @OA\Property(property="konten", type="string", example="Ini adalah konten sejarah perusahaan."))
     * ),
     * @OA\Response(response=201, description="Berhasil dibuat"),
     * @OA\Response(response=409, description="Data sudah ada"),
     * @OA\Response(response=422, description="Validasi gagal")
     * )
     */
    public function store(Request $request)
    {
        if (Sejarah::count() > 0) {
            return response()->json([
                'success' => false,
                'message' => 'Data Sejarah sudah ada. Gunakan endpoint UPDATE untuk mengubahnya.',
            ], 409); // 409 Conflict
        }

        $validator = Validator::make($request->all(), [
            'konten' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        $sejarah = Sejarah::create($validator->validated());

        return response()->json([
            'success' => true,
            'message' => 'Sejarah berhasil ditambahkan.',
            'data'    => $sejarah,
        ], 201);
    }

    /**
     * @OA\Put(
     * path="/api/sejarah/{id}",
     * operationId="updateSejarah",
     * tags={"Sejarah"},
     * summary="Memperbarui data Sejarah",
     * security={{"bearerAuth":{}}},
     * @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     * @OA\RequestBody(
     * required=true,
     * @OA\JsonContent(required={"konten"}, @OA\Property(property="konten", type="string", example="Ini adalah konten sejarah yang sudah diperbarui."))
     * ),
     * @OA\Response(response=200, description="Berhasil diperbarui"),
     * @OA\Response(response=404, description="Data tidak ditemukan")
     * )
     */
    public function update(Request $request, Sejarah $sejarah)
    {
        $validator = Validator::make($request->all(), [
            'konten' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        $sejarah->update($validator->validated());

        return response()->json([
            'success' => true,
            'message' => 'Sejarah berhasil diperbarui.',
            'data'    => $sejarah,
        ]);
    }

    /**
     * @OA\Delete(
     * path="/api/sejarah/{id}",
     * operationId="deleteSejarah",
     * tags={"Sejarah"},
     * summary="Menghapus data Sejarah",
     * security={{"bearerAuth":{}}},
     * @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     * @OA\Response(response=200, description="Berhasil dihapus"),
     * @OA\Response(response=404, description="Data tidak ditemukan")
     * )
     */
    public function destroy(Sejarah $sejarah)
    {
        $sejarah->delete();
        return response()->json(['success' => true, 'message' => 'Sejarah berhasil dihapus.']);
    }
}