<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class DocumentController extends Controller
{
    /**
     * @OA\Get(
     * path="/api/documents",
     * operationId="getDocuments",
     * tags={"Dokumen"},
     * summary="Menampilkan semua dokumen (untuk admin/publik)",
     * description="Mengambil daftar dokumen dengan paginasi. Endpoint ini bisa difilter berdasarkan 'kategori' dan 'search'. Untuk admin, endpoint ini menampilkan semua dokumen. Untuk user biasa, hanya menampilkan dokumen yang bersifat publik.",
     * @OA\Parameter(name="kategori", in="query", required=false, @OA\Schema(type="string")),
     * @OA\Parameter(name="search", in="query", required=false, @OA\Schema(type="string")),
     * @OA\Response(response=200, description="Operasi berhasil")
     * )
     */
    public function index(Request $request)
    {
        // Cek apakah user yang login adalah admin (asumsi punya role/permission)
        // Untuk contoh ini, kita asumsikan jika ada token, maka dia admin
        $is_admin = auth('sanctum')->check();

        $query = Document::with('user')->latest();

        // Jika bukan admin, hanya tampilkan yang public
        if (!$is_admin) {
            $query->where('is_public', true);
        }

        // Filter by kategori
        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%");
            });
        }

        $documents = $query->paginate(12)->appends($request->query());

        return response()->json(['success' => true, 'data' => $documents]);
    }

    /**
     * @OA\Post(
     * path="/api/documents",
     * operationId="storeDocument",
     * tags={"Dokumen"},
     * summary="Membuat dokumen baru",
     * security={{"bearerAuth":{}}},
     * @OA\RequestBody(
     * required=true,
     * @OA\MediaType(
     * mediaType="multipart/form-data",
     * @OA\Schema(
     * type="object",
     * required={"judul", "document", "is_public"},
     * @OA\Property(property="judul", type="string"),
     * @OA\Property(property="deskripsi", type="string"),
     * @OA\Property(property="document", type="file", format="binary"),
     * @OA\Property(property="kategori", type="string", enum={"Surat", "Laporan", "Peraturan", "Pengumuman", "Formulir", "Lainnya"}),
     * @OA\Property(property="is_public", type="boolean")
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
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'document' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:10240',
            'kategori' => 'nullable|string|max:100',
            'is_public' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        $validated = $validator->validated();
        $file = $request->file('document');
        $filePath = $file->store('documents', 'public');

        $document = Document::create([
            'judul' => $validated['judul'],
            'deskripsi' => $validated['deskripsi'] ?? null,
            'file_path' => $filePath,
            'file_name' => $file->getClientOriginalName(),
            'file_size' => $file->getSize(),
            'file_extension' => $file->getClientOriginalExtension(),
            'kategori' => $validated['kategori'] ?? null,
            'is_public' => $validated['is_public'],
            'user_id' => Auth::id(),
        ]);

        return response()->json(['success' => true, 'message' => 'Dokumen berhasil diupload.', 'data' => $document], 201);
    }
    
    /**
     * @OA\Get(
     * path="/api/documents/{id}",
     * operationId="getDocumentById",
     * tags={"Dokumen"},
     * summary="Menampilkan detail satu dokumen",
     * @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     * @OA\Response(response=200, description="Operasi berhasil"),
     * @OA\Response(response=403, description="Akses ditolak"),
     * @OA\Response(response=404, description="Data tidak ditemukan")
     * )
     */
    public function show(Document $document)
    {
        // Jika dokumen tidak public dan user tidak terautentikasi, tolak akses
        if (!$document->is_public && !auth('sanctum')->check()) {
            return response()->json(['success' => false, 'message' => 'Akses ditolak. Dokumen ini tidak bersifat publik.'], 403);
        }

        return response()->json(['success' => true, 'data' => $document]);
    }

    /**
     * @OA\Post(
     * path="/api/documents/{id}",
     * operationId="updateDocument",
     * tags={"Dokumen"},
     * summary="Memperbarui dokumen (gunakan POST dengan _method=PUT)",
     * security={{"bearerAuth":{}}},
     * @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     * @OA\RequestBody(
     * required=true,
     * @OA\MediaType(
     * mediaType="multipart/form-data",
     * @OA\Schema(
     * type="object",
     * required={"judul", "is_public", "_method"},
     * @OA\Property(property="_method", type="string", example="PUT"),
     * @OA\Property(property="judul", type="string"),
     * @OA\Property(property="deskripsi", type="string"),
     * @OA\Property(property="document", type="file", format="binary"),
     * @OA\Property(property="kategori", type="string"),
     * @OA\Property(property="is_public", type="boolean")
     * )
     * )
     * ),
     * @OA\Response(response=200, description="Berhasil diperbarui"),
     * @OA\Response(response=422, description="Validasi gagal")
     * )
     */
    public function update(Request $request, Document $document)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'document' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:10240',
            'kategori' => 'nullable|string|max:100',
            'is_public' => 'required|boolean',
        ]);
        
        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }
        
        $validated = $validator->validated();
        
        if ($request->hasFile('document')) {
            Storage::disk('public')->delete($document->file_path);
            $file = $request->file('document');
            $filePath = $file->store('documents', 'public');

            $validated['file_path'] = $filePath;
            $validated['file_name'] = $file->getClientOriginalName();
            $validated['file_size'] = $file->getSize();
            $validated['file_extension'] = $file->getClientOriginalExtension();
        }

        $document->update($validated);

        return response()->json(['success' => true, 'message' => 'Dokumen berhasil diperbarui.', 'data' => $document]);
    }

    /**
     * @OA\Delete(
     * path="/api/documents/{id}",
     * operationId="deleteDocument",
     * tags={"Dokumen"},
     * summary="Menghapus dokumen",
     * security={{"bearerAuth":{}}},
     * @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     * @OA\Response(response=200, description="Berhasil dihapus"),
     * @OA\Response(response=404, description="Data tidak ditemukan")
     * )
     */
    public function destroy(Document $document)
    {
        Storage::disk('public')->delete($document->file_path);
        $document->delete();

        return response()->json(['success' => true, 'message' => 'Dokumen berhasil dihapus.']);
    }

    /**
     * @OA\Get(
     * path="/api/documents/{id}/download",
     * operationId="downloadDocument",
     * tags={"Dokumen"},
     * summary="Mengunduh file dokumen",
     * @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     * @OA\Response(response=200, description="File berhasil diunduh"),
     * @OA\Response(response=403, description="Akses ditolak"),
     * @OA\Response(response=404, description="File tidak ditemukan")
     * )
     */
    public function download(Document $document)
    {
        if (!$document->is_public && !auth('sanctum')->check()) {
            return response()->json(['success' => false, 'message' => 'Akses ditolak. Dokumen ini tidak bersifat publik.'], 403);
        }

        $pathToFile = storage_path('app/public/' . $document->file_path);

        if (!file_exists($pathToFile)) {
            return response()->json(['success' => false, 'message' => 'File tidak ditemukan di server.'], 404);
        }

        $document->increment('download_count');

        return response()->download($pathToFile, $document->file_name);
    }
}