<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\OrganizationalStructure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class OrganizationalStructureController extends Controller
{
    /**
     * @OA\Get(
     * path="/api/struktur-organisasi",
     * operationId="getStructures",
     * tags={"Struktur Organisasi"},
     * summary="Menampilkan semua data struktur organisasi",
     * description="Mengambil semua data yang diurutkan berdasarkan seksi dan urutan, lalu dikelompokkan berdasarkan seksi.",
     * @OA\Response(response=200, description="Operasi berhasil")
     * )
     */
    public function index()
    {
        $structures = OrganizationalStructure::orderBy('section')
            ->orderBy('order')
            ->get();

        // Mengelompokkan data seperti di controller web Anda
        $groupedStructures = $structures->groupBy('section');

        return response()->json(['success' => true, 'data' => $groupedStructures]);
    }

    /**
     * @OA\Post(
     * path="/api/struktur-organisasi",
     * operationId="storeStructure",
     * tags={"Struktur Organisasi"},
     * summary="Membuat data struktur organisasi baru",
     * security={{"bearerAuth":{}}},
     * @OA\RequestBody(
     * required=true,
     * @OA\MediaType(
     * mediaType="multipart/form-data",
     * @OA\Schema(
     * type="object",
     * required={"name","position","section","order"},
     * @OA\Property(property="name", type="string", example="John Doe"),
     * @OA\Property(property="position", type="string", example="Kepala Seksi"),
     * @OA\Property(property="nip", type="string", example="123456789"),
     * @OA\Property(property="photo", type="file", format="binary"),
     * @OA\Property(property="section", type="integer", example=1),
     * @OA\Property(property="order", type="integer", example=1)
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
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'nip' => 'nullable|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:5048',
            'section' => 'required|integer|min:1',
            'order' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        $validated = $validator->validated();

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('organizational-photos', 'public');
            $validated['photo'] = $photoPath;
        }

        $structure = OrganizationalStructure::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Struktur organisasi berhasil ditambahkan.',
            'data' => $structure,
        ], 201);
    }

    /**
     * @OA\Get(
     * path="/api/struktur-organisasi/{id}",
     * operationId="getStructureById",
     * tags={"Struktur Organisasi"},
     * summary="Menampilkan detail satu data struktur organisasi",
     * @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     * @OA\Response(response=200, description="Operasi berhasil"),
     * @OA\Response(response=404, description="Data tidak ditemukan")
     * )
     */
    public function show(OrganizationalStructure $organizationalStructure)
    {
        return response()->json(['success' => true, 'data' => $organizationalStructure]);
    }

    /**
     * @OA\Post(
     * path="/api/struktur-organisasi/{id}",
     * operationId="updateStructure",
     * tags={"Struktur Organisasi"},
     * summary="Memperbarui data struktur organisasi (gunakan method POST dengan _method=PUT)",
     * description="Karena form-data tidak secara native mendukung PUT, kita 'menumpang' di method POST.",
     * security={{"bearerAuth":{}}},
     * @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     * @OA\RequestBody(
     * required=true,
     * @OA\MediaType(
     * mediaType="multipart/form-data",
     * @OA\Schema(
     * type="object",
     * required={"name","position","section","order", "_method"},
     * @OA\Property(property="_method", type="string", example="PUT"),
     * @OA\Property(property="name", type="string"),
     * @OA\Property(property="position", type="string"),
     * @OA\Property(property="photo", type="file", format="binary"),
     * @OA\Property(property="section", type="integer"),
     * @OA\Property(property="order", type="integer")
     * )
     * )
     * ),
     * @OA\Response(response=200, description="Berhasil diperbarui"),
     * @OA\Response(response=422, description="Validasi gagal")
     * )
     */
    public function update(Request $request, OrganizationalStructure $organizationalStructure)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'nip' => 'nullable|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:5048',
            'section' => 'required|integer|min:1',
            'order' => 'required|integer|min:1',
        ]);
        
        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        $validated = $validator->validated();

        if ($request->hasFile('photo')) {
            // Hapus foto lama jika ada
            if ($organizationalStructure->photo) {
                Storage::disk('public')->delete($organizationalStructure->photo);
            }
            $photoPath = $request->file('photo')->store('organizational-photos', 'public');
            $validated['photo'] = $photoPath;
        }

        $organizationalStructure->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Struktur organisasi berhasil diperbarui.',
            'data' => $organizationalStructure,
        ]);
    }

    /**
     * @OA\Delete(
     * path="/api/struktur-organisasi/{id}",
     * operationId="deleteStructure",
     * tags={"Struktur Organisasi"},
     * summary="Menghapus data struktur organisasi",
     * security={{"bearerAuth":{}}},
     * @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     * @OA\Response(response=200, description="Berhasil dihapus"),
     * @OA\Response(response=404, description="Data tidak ditemukan")
     * )
     */
    public function destroy(OrganizationalStructure $organizationalStructure)
    {
        if ($organizationalStructure->photo) {
            Storage::disk('public')->delete($organizationalStructure->photo);
        }

        $organizationalStructure->delete();

        return response()->json(['success' => true, 'message' => 'Struktur organisasi berhasil dihapus.']);
    }
}