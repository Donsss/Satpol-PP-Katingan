<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Agenda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AgendaController extends Controller
{
    /**
     * @OA\Get(
     * path="/api/agenda",
     * operationId="getAgendaList",
     * tags={"Agenda"},
     * summary="Menampilkan daftar agenda",
     * description="Mengambil daftar semua agenda dengan paginasi, diurutkan dari yang terbaru.",
     * @OA\Parameter(
     * name="page",
     * in="query",
     * description="Nomor halaman untuk paginasi",
     * required=false,
     * @OA\Schema(type="integer")
     * ),
     * @OA\Response(
     * response=200,
     * description="Operasi berhasil",
     * @OA\JsonContent(
     * type="object",
     * @OA\Property(property="success", type="boolean", example=true),
     * @OA\Property(property="data", type="object",
     * @OA\Property(property="current_page", type="integer", example=1),
     * @OA\Property(property="data", type="array",
     * @OA\Items(
     * type="object",
     * @OA\Property(property="id", type="integer", example=1),
     * @OA\Property(property="judul", type="string", example="Rapat Pleno"),
     * @OA\Property(property="tanggal", type="string", format="date", example="2024-11-20"),
     * @OA\Property(property="waktu", type="string", format="time", example="09:30:00"),
     * @OA\Property(property="lokasi", type="string", nullable=true, example="Gedung Serbaguna"),
     * @OA\Property(property="deskripsi", type="string", nullable=true, example="Pembahasan agenda tahunan."),
     * @OA\Property(property="created_at", type="string", format="date-time"),
     * @OA\Property(property="updated_at", type="string", format="date-time")
     * )
     * ),
     * @OA\Property(property="last_page", type="integer", example=5),
     * @OA\Property(property="per_page", type="integer", example=10),
     * @OA\Property(property="total", type="integer", example=50)
     * )
     * )
     * )
     * )
     */
    public function index()
    {
        $agendas = Agenda::orderBy('tanggal', 'desc')->paginate(10);
        return response()->json([
            'success' => true,
            'data' => $agendas,
        ]);
    }

    /**
     * @OA\Post(
     * path="/api/agenda",
     * operationId="storeAgenda",
     * tags={"Agenda"},
     * summary="Menambahkan agenda baru",
     * description="Membuat data agenda baru.",
     * security={{"bearerAuth":{}}},
     * @OA\RequestBody(
     * required=true,
     * description="Data agenda yang akan dibuat",
     * @OA\JsonContent(
     * required={"judul", "tanggal", "waktu"},
     * @OA\Property(property="judul", type="string", example="Rapat Koordinasi Bulanan"),
     * @OA\Property(property="tanggal", type="string", format="date", example="2024-12-31"),
     * @OA\Property(property="waktu", type="string", format="time", example="14:00"),
     * @OA\Property(property="lokasi", type="string", nullable=true, example="Aula Utama Gedung A"),
     * @OA\Property(property="deskripsi", type="string", nullable=true, example="Pembahasan laporan kuartal terakhir.")
     * )
     * ),
     * @OA\Response(
     * response=201,
     * description="Berhasil dibuat",
     * @OA\JsonContent(
     * @OA\Property(property="success", type="boolean", example=true),
     * @OA\Property(property="message", type="string", example="Agenda berhasil ditambahkan."),
     * @OA\Property(property="data", type="object",
     * @OA\Property(property="id", type="integer", example=1),
     * @OA\Property(property="judul", type="string", example="Rapat Koordinasi Bulanan"),
     * @OA\Property(property="tanggal", type="string", format="date", example="2024-12-31"),
     * @OA\Property(property="waktu", type="string", format="time", example="14:00:00"),
     * @OA\Property(property="lokasi", type="string", nullable=true, example="Aula Utama Gedung A"),
     * @OA\Property(property="deskripsi", type="string", nullable=true, example="Pembahasan laporan kuartal terakhir."),
     * @OA\Property(property="created_at", type="string", format="date-time"),
     * @OA\Property(property="updated_at", type="string", format="date-time")
     * )
     * )
     * ),
     * @OA\Response(response=401, description="Unauthorized"),
     * @OA\Response(response=422, description="Validation Error")
     * )
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'waktu' => 'required|date_format:H:i',
            'lokasi' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        $agenda = Agenda::create($validator->validated());

        return response()->json([
            'success' => true,
            'message' => 'Agenda berhasil ditambahkan.',
            'data' => $agenda,
        ], 201);
    }

    /**
     * @OA\Get(
     * path="/api/agenda/{id}",
     * operationId="getAgendaById",
     * tags={"Agenda"},
     * summary="Menampilkan detail agenda",
     * description="Mengambil data detail sebuah agenda berdasarkan ID.",
     * @OA\Parameter(
     * name="id",
     * description="ID dari agenda",
     * required=true,
     * in="path",
     * @OA\Schema(type="integer")
     * ),
     * @OA\Response(
     * response=200,
     * description="Operasi berhasil",
     * @OA\JsonContent(
     * @OA\Property(property="success", type="boolean", example=true),
     * @OA\Property(property="data", type="object",
     * @OA\Property(property="id", type="integer", example=1),
     * @OA\Property(property="judul", type="string", example="Rapat Pleno"),
     * @OA\Property(property="tanggal", type="string", format="date", example="2024-11-20"),
     * @OA\Property(property="waktu", type="string", format="time", example="09:30:00"),
     * @OA\Property(property="lokasi", type="string", nullable=true, example="Gedung Serbaguna"),
     * @OA\Property(property="deskripsi", type="string", nullable=true, example="Pembahasan agenda tahunan."),
     * @OA\Property(property="created_at", type="string", format="date-time"),
     * @OA\Property(property="updated_at", type="string", format="date-time")
     * )
     * )
     * ),
     * @OA\Response(response=404, description="Data tidak ditemukan")
     * )
     */
    public function show(Agenda $agenda)
    {
        return response()->json([
            'success' => true,
            'data' => $agenda,
        ]);
    }

    /**
     * @OA\Put(
     * path="/api/agenda/{id}",
     * operationId="updateAgenda",
     * tags={"Agenda"},
     * summary="Memperbarui agenda",
     * description="Memperbarui data agenda yang sudah ada.",
     * security={{"bearerAuth":{}}},
     * @OA\Parameter(
     * name="id",
     * description="ID dari agenda",
     * required=true,
     * in="path",
     * @OA\Schema(type="integer")
     * ),
     * @OA\RequestBody(
     * required=true,
     * description="Data agenda yang akan diperbarui",
     * @OA\JsonContent(
     * required={"judul", "tanggal", "waktu"},
     * @OA\Property(property="judul", type="string", example="Rapat Koordinasi Tahunan (Revisi)"),
     * @OA\Property(property="tanggal", type="string", format="date", example="2025-01-15"),
     * @OA\Property(property="waktu", type="string", format="time", example="10:00"),
     * @OA\Property(property="lokasi", type="string", nullable=true, example="Ruang Meeting VIP"),
     * @OA\Property(property="deskripsi", type="string", nullable=true, example="Pembahasan rencana strategis tahunan.")
     * )
     * ),
     * @OA\Response(
     * response=200,
     * description="Berhasil diperbarui",
     * @OA\JsonContent(
     * @OA\Property(property="success", type="boolean", example=true),
     * @OA\Property(property="message", type="string", example="Agenda berhasil diperbarui."),
     * @OA\Property(property="data", type="object",
     * @OA\Property(property="id", type="integer", example=1),
     * @OA\Property(property="judul", type="string", example="Rapat Koordinasi Tahunan (Revisi)"),
     * @OA\Property(property="tanggal", type="string", format="date", example="2025-01-15"),
     * @OA\Property(property="waktu", type="string", format="time", example="10:00:00"),
     * @OA\Property(property="lokasi", type="string", nullable=true, example="Ruang Meeting VIP"),
     * @OA\Property(property="deskripsi", type="string", nullable=true, example="Pembahasan rencana strategis tahunan."),
     * @OA\Property(property="created_at", type="string", format="date-time"),
     * @OA\Property(property="updated_at", type="string", format="date-time")
     * )
     * )
     * ),
     * @OA\Response(response=401, description="Unauthorized"),
     * @OA\Response(response=404, description="Data tidak ditemukan"),
     * @OA\Response(response=422, description="Validation Error")
     * )
     */
    public function update(Request $request, Agenda $agenda)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'waktu' => 'required|date_format:H:i',
            'lokasi' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        $agenda->update($validator->validated());

        return response()->json([
            'success' => true,
            'message' => 'Agenda berhasil diperbarui.',
            'data' => $agenda,
        ]);
    }

    /**
     * @OA\Delete(
     * path="/api/agenda/{id}",
     * operationId="deleteAgenda",
     * tags={"Agenda"},
     * summary="Menghapus agenda",
     * description="Menghapus data agenda secara permanen.",
     * security={{"bearerAuth":{}}},
     * @OA\Parameter(
     * name="id",
     * description="ID dari agenda yang akan dihapus",
     * required=true,
     * in="path",
     * @OA\Schema(type="integer")
     * ),
     * @OA\Response(
     * response=200,
     * description="Berhasil dihapus",
     * @OA\JsonContent(
     * @OA\Property(property="success", type="boolean", example=true),
     * @OA\Property(property="message", type="string", example="Agenda berhasil dihapus.")
     * )
     * ),
     * @OA\Response(response=401, description="Unauthorized"),
     * @OA\Response(response=404, description="Data tidak ditemukan")
     * )
     */
    public function destroy(Agenda $agenda)
    {
        $agenda->delete();
        return response()->json([
            'success' => true,
            'message' => 'Agenda berhasil dihapus.',
        ]);
    }
}