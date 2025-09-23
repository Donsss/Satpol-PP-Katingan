<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kontak;
use Carbon\Carbon;
use Illuminate\Http\Request;

class KontakController extends Controller
{
    /**
     * @OA\Get(
     * path="/api/kontak",
     * operationId="getKontakList",
     * tags={"Pesan Kontak"},
     * summary="Menampilkan daftar semua pesan kontak",
     * description="Mengambil semua pesan kontak yang masuk dengan paginasi.",
     * security={{"bearerAuth":{}}},
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
     * @OA\Property(property="id", type="integer", readOnly=true, example=1),
     * @OA\Property(property="nama_lengkap", type="string", example="Budi Santoso"),
     * @OA\Property(property="email", type="string", format="email", example="budi.s@example.com"),
     * @OA\Property(property="telepon", type="string", nullable=true, example="08123456789"),
     * @OA\Property(property="tipe_pesan", type="string", enum={"Pertanyaan", "Saran", "Kritik", "Lainnya"}, example="Saran"),
     * @OA\Property(property="isi_pesan", type="string", example="Saran saya agar websitenya lebih dioptimalkan."),
     * @OA\Property(property="read_at", type="string", format="date-time", nullable=true),
     * @OA\Property(property="created_at", type="string", format="date-time", readOnly=true),
     * @OA\Property(property="updated_at", type="string", format="date-time", readOnly=true)
     * )
     * ),
     * @OA\Property(property="last_page", type="integer", example=10),
     * @OA\Property(property="per_page", type="integer", example=15),
     * @OA\Property(property="total", type="integer", example=150)
     * )
     * )
     * ),
     * @OA\Response(
     * response=401,
     * description="Unauthorized (Token tidak valid)"
     * )
     * )
     */
    public function index()
    {
        $kontaks = Kontak::latest()->paginate(15);
        return response()->json([
            'success' => true,
            'data' => $kontaks,
        ]);
    }

    /**
     * @OA\Get(
     * path="/api/kontak/{id}",
     * operationId="getKontakById",
     * tags={"Pesan Kontak"},
     * summary="Menampilkan detail pesan kontak",
     * description="Mengambil detail satu pesan dan otomatis menandainya sebagai sudah dibaca.",
     * security={{"bearerAuth":{}}},
     * @OA\Parameter(
     * name="id",
     * description="ID dari pesan kontak",
     * required=true,
     * in="path",
     * @OA\Schema(type="integer")
     * ),
     * @OA\Response(
     * response=200,
     * description="Operasi berhasil",
     * @OA\JsonContent(
     * type="object",
     * @OA\Property(property="success", type="boolean", example=true),
     * @OA\Property(property="data", type="object",
     * @OA\Property(property="id", type="integer", readOnly=true, example=1),
     * @OA\Property(property="nama_lengkap", type="string", example="Budi Santoso"),
     * @OA\Property(property="email", type="string", format="email", example="budi.s@example.com"),
     * @OA\Property(property="telepon", type="string", nullable=true, example="08123456789"),
     * @OA\Property(property="tipe_pesan", type="string", enum={"Pertanyaan", "Saran", "Kritik", "Lainnya"}, example="Saran"),
     * @OA\Property(property="isi_pesan", type="string", example="Saran saya agar websitenya lebih dioptimalkan."),
     * @OA\Property(property="read_at", type="string", format="date-time", nullable=true),
     * @OA\Property(property="created_at", type="string", format="date-time", readOnly=true),
     * @OA\Property(property="updated_at", type="string", format="date-time", readOnly=true)
     * )
     * )
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
    public function show(Kontak $kontak)
    {
        // Jika pesan belum dibaca, tandai sebagai sudah dibaca
        if (is_null($kontak->read_at)) {
            $kontak->update(['read_at' => Carbon::now()]);
        }

        return response()->json([
            'success' => true,
            'data' => $kontak,
        ]);
    }

    /**
     * @OA\Delete(
     * path="/api/kontak/{id}",
     * operationId="deleteKontak",
     * tags={"Pesan Kontak"},
     * summary="Menghapus pesan kontak",
     * description="Menghapus data pesan kontak secara permanen.",
     * security={{"bearerAuth":{}}},
     * @OA\Parameter(
     * name="id",
     * description="ID dari pesan yang akan dihapus",
     * required=true,
     * in="path",
     * @OA\Schema(type="integer")
     * ),
     * @OA\Response(
     * response=200,
     * description="Berhasil dihapus",
     * @OA\JsonContent(
     * type="object",
     * @OA\Property(property="success", type="boolean", example=true),
     * @OA\Property(property="message", type="string", example="Pesan berhasil dihapus.")
     * )
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
    public function destroy(Kontak $kontak)
    {
        $kontak->delete();

        return response()->json([
            'success' => true,
            'message' => 'Pesan berhasil dihapus.',
        ]);
    }
}

