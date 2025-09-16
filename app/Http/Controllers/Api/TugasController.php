<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TugasController extends Controller
{
    /**
     * @OA\Get(
     * path="/api/tugas",
     * operationId="getTugas",
     * tags={"Tugas & Fungsi"},
     * summary="Menampilkan data Tugas & Fungsi",
     * description="Mengambil data Tugas & Fungsi yang tersimpan (hanya ada satu).",
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
        $tugas = Tugas::first();

        if (!$tugas) {
            return response()->json(['success' => false, 'message' => 'Data Tugas & Fungsi tidak ditemukan.'], 404);
        }

        return response()->json(['success' => true, 'data' => $tugas]);
    }

    /**
     * @OA\Post(
     * path="/api/tugas",
     * operationId="storeTugas",
     * tags={"Tugas & Fungsi"},
     * summary="Membuat data Tugas & Fungsi baru",
     * description="Hanya bisa dijalankan jika belum ada data sama sekali.",
     * security={{"bearerAuth":{}}},
     * @OA\RequestBody(
     * required=true,
     * @OA\JsonContent(required={"konten"}, @OA\Property(property="konten", type="string", example="Ini adalah konten tugas dan fungsi."))
     * ),
     * @OA\Response(response=201, description="Berhasil dibuat"),
     * @OA\Response(response=409, description="Data sudah ada"),
     * @OA\Response(response=422, description="Validasi gagal")
     * )
     */
    public function store(Request $request)
    {
        if (Tugas::count() > 0) {
            return response()->json([
                'success' => false,
                'message' => 'Data Tugas & Fungsi sudah ada. Gunakan endpoint UPDATE untuk mengubahnya.',
            ], 409); // 409 Conflict
        }

        $validator = Validator::make($request->all(), [
            'konten' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        $tugas = Tugas::create($validator->validated());

        return response()->json([
            'success' => true,
            'message' => 'Tugas & Fungsi berhasil ditambahkan.',
            'data'    => $tugas,
        ], 201); // 201 Created
    }
    
    /**
     * @OA\Put(
     * path="/api/tugas/{id}",
     * operationId="updateTugas",
     * tags={"Tugas & Fungsi"},
     * summary="Memperbarui data Tugas & Fungsi",
     * description="Memperbarui data Tugas & Fungsi yang sudah ada.",
     * security={{"bearerAuth":{}}},
     * @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     * @OA\RequestBody(
     * required=true,
     * @OA\JsonContent(required={"konten"}, @OA\Property(property="konten", type="string", example="Ini adalah konten yang sudah diperbarui."))
     * ),
     * @OA\Response(response=200, description="Berhasil diperbarui"),
     * @OA\Response(response=404, description="Data tidak ditemukan")
     * )
     */
    public function update(Request $request, Tugas $tuga)
    {
        $validator = Validator::make($request->all(), [
            'konten' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        $tuga->update($validator->validated());

        return response()->json([
            'success' => true,
            'message' => 'Tugas & Fungsi berhasil diperbarui.',
            'data'    => $tuga,
        ]);
    }

    /**
     * @OA\Delete(
     * path="/api/tugas/{id}",
     * operationId="deleteTugas",
     * tags={"Tugas & Fungsi"},
     * summary="Menghapus data Tugas & Fungsi",
     * security={{"bearerAuth":{}}},
     * @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     * @OA\Response(response=200, description="Berhasil dihapus"),
     * @OA\Response(response=404, description="Data tidak ditemukan")
     * )
     */
    public function destroy(Tugas $tuga)
    {
        $tuga->delete();
        return response()->json(['success' => true, 'message' => 'Tugas & Fungsi berhasil dihapus.']);
    }
}