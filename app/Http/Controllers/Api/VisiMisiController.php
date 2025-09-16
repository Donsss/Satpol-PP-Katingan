<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\VisiMisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VisiMisiController extends Controller
{
    /**
     * @OA\Get(
     * path="/api/visi-misi",
     * operationId="getVisiMisiList",
     * tags={"Visi & Misi"},
     * summary="Menampilkan data Visi & Misi",
     * description="Mengambil data Visi & Misi yang tersimpan di database (biasanya hanya ada satu).",
     * @OA\Response(
     * response=200,
     * description="Operasi berhasil",
     * @OA\JsonContent(
     * type="object",
     * @OA\Property(property="success", type="boolean", example=true),
     * @OA\Property(property="data", type="object",
     * @OA\Property(property="id", type="integer", example=1),
     * @OA\Property(property="visi", type="string", example="Menjadi institusi terdepan..."),
     * @OA\Property(property="misi", type="string", example="1. Memberikan pelayanan..."),
     * @OA\Property(property="created_at", type="string", format="date-time"),
     * @OA\Property(property="updated_at", type="string", format="date-time")
     * )
     * )
     * ),
     * @OA\Response(
     * response=404,
     * description="Data tidak ditemukan"
     * )
     * )
     */
    public function index()
    {
        $visiMisi = VisiMisi::first();

        if (!$visiMisi) {
            return response()->json([
                'success' => false,
                'message' => 'Data Visi & Misi tidak ditemukan.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $visiMisi,
        ]);
    }

    /**
     * @OA\Post(
     * path="/api/visi-misi",
     * operationId="storeVisiMisi",
     * tags={"Visi & Misi"},
     * summary="Membuat data Visi & Misi baru",
     * description="Hanya bisa dijalankan jika belum ada data Visi & Misi sama sekali.",
     * security={{"bearerAuth":{}}},
     * @OA\RequestBody(
     * required=true,
     * @OA\JsonContent(
     * required={"visi","misi"},
     * @OA\Property(property="visi", type="string", example="Visi baru perusahaan."),
     * @OA\Property(property="misi", type="string", example="Misi baru perusahaan.")
     * )
     * ),
     * @OA\Response(
     * response=201,
     * description="Berhasil dibuat"
     * ),
     * @OA\Response(
     * response=401,
     * description="Unauthorized (Token tidak valid atau tidak ada)"
     * ),
     * @OA\Response(
     * response=409,
     * description="Conflict (Data sudah ada)"
     * ),
     * @OA\Response(
     * response=422,
     * description="Validation Error"
     * )
     * )
     */
    public function store(Request $request)
    {
        if (VisiMisi::count() > 0) {
            return response()->json([
                'success' => false,
                'message' => 'Data Visi & Misi sudah ada. Gunakan endpoint UPDATE untuk mengubahnya.',
            ], 409);
        }

        $validator = Validator::make($request->all(), [
            'visi' => 'required|string',
            'misi' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        $visiMisi = VisiMisi::create($validator->validated());

        return response()->json([
            'success' => true,
            'message' => 'Visi & Misi berhasil ditambahkan.',
            'data'    => $visiMisi,
        ], 201);
    }

    /**
     * @OA\Get(
     * path="/api/visi-misi/{id}",
     * operationId="getVisiMisiById",
     * tags={"Visi & Misi"},
     * summary="Menampilkan detail Visi & Misi",
     * description="Mengambil data detail Visi & Misi berdasarkan ID.",
     * @OA\Parameter(
     * name="id",
     * description="ID dari Visi & Misi",
     * required=true,
     * in="path",
     * @OA\Schema(
     * type="integer"
     * )
     * ),
     * @OA\Response(
     * response=200,
     * description="Operasi berhasil"
     * ),
     * @OA\Response(
     * response=404,
     * description="Data tidak ditemukan"
     * )
     * )
     */
    public function show(VisiMisi $visiMisi)
    {
        return response()->json([
            'success' => true,
            'data' => $visiMisi,
        ]);
    }

    /**
     * @OA\Put(
     * path="/api/visi-misi/{id}",
     * operationId="updateVisiMisi",
     * tags={"Visi & Misi"},
     * summary="Memperbarui data Visi & Misi",
     * description="Memperbarui data Visi & Misi yang sudah ada.",
     * security={{"bearerAuth":{}}},
     * @OA\Parameter(
     * name="id",
     * description="ID dari Visi & Misi",
     * required=true,
     * in="path",
     * @OA\Schema(
     * type="integer"
     * )
     * ),
     * @OA\RequestBody(
     * required=true,
     * @OA\JsonContent(
     * required={"visi","misi"},
     * @OA\Property(property="visi", type="string", example="Visi yang sudah diperbarui."),
     * @OA\Property(property="misi", type="string", example="Misi yang sudah diperbarui.")
     * )
     * ),
     * @OA\Response(
     * response=200,
     * description="Berhasil diperbarui"
     * ),
     * @OA\Response(
     * response=401,
     * description="Unauthorized"
     * ),
     * @OA\Response(
     * response=404,
     * description="Data tidak ditemukan"
     * )
     * )
     */
    public function update(Request $request, VisiMisi $visiMisi)
    {
        $validator = Validator::make($request->all(), [
            'visi' => 'required|string',
            'misi' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        $visiMisi->update($validator->validated());

        return response()->json([
            'success' => true,
            'message' => 'Visi & Misi berhasil diperbarui.',
            'data'    => $visiMisi,
        ]);
    }

    /**
     * @OA\Delete(
     * path="/api/visi-misi/{id}",
     * operationId="deleteVisiMisi",
     * tags={"Visi & Misi"},
     * summary="Menghapus data Visi & Misi",
     * description="Menghapus data Visi & Misi yang ada.",
     * security={{"bearerAuth":{}}},
     * @OA\Parameter(
     * name="id",
     * description="ID dari Visi & Misi yang akan dihapus",
     * required=true,
     * in="path",
     * @OA\Schema(
     * type="integer"
     * )
     * ),
     * @OA\Response(
     * response=200,
     * description="Berhasil dihapus"
     * ),
     * @OA\Response(
     * response=401,
     * description="Unauthorized"
     * ),
     * @OA\Response(
     * response=404,
     * description="Data tidak ditemukan"
     * )
     * )
     */
    public function destroy(VisiMisi $visiMisi)
    {
        $visiMisi->delete();

        return response()->json([
            'success' => true,
            'message' => 'Visi & Misi berhasil dihapus.',
        ]);
    }
}