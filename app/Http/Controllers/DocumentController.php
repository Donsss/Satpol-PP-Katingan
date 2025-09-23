<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class DocumentController extends Controller
{
    public function index()
    {
        $query = Document::with('user')->latest();

        if (request('kategori')) {
            $query->where('kategori', request('kategori'));
        }

        $documents = $query->paginate(12);
        $kategories = Document::select('kategori')->whereNotNull('kategori')->distinct()->pluck('kategori');

        return view('documents.index', [
            'documents' => $documents,
            'kategories' => $kategories,
            'pageTitle' => 'Manajemen Dokumen'
        ]);
    }

    public function create()
    {
        return view('documents.create', [
            'pageTitle' => 'Tambah Dokumen Baru',
            'kategories' => ['Surat', 'Laporan', 'Peraturan', 'Pengumuman', 'Formulir', 'Lainnya']
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'document' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:7168',
            'kategori' => 'nullable|string|max:100',
            'is_public' => 'required|boolean'
        ]);

        $file = $request->file('document');
        $filePath = $file->store('documents');
        $fileExtension = $file->getClientOriginalExtension();

        Document::create([
            'judul' => $validated['judul'],
            'deskripsi' => $validated['deskripsi'],
            'file_path' => $filePath,
            'file_name' => $file->getClientOriginalName(),
            'file_size' => $file->getSize(),
            'file_extension' => $fileExtension,
            'kategori' => $validated['kategori'],
            'is_public' => $validated['is_public'],
            'user_id' => Auth::id()
        ]);

        return redirect()->route('admin.documents.index')
            ->with('success', 'Dokumen berhasil ditambahkan!');
    }

    public function show(Document $document)
    {
        return view('documents.show', [
            'document' => $document,
            'pageTitle' => 'Detail Dokumen'
        ]);
    }

    public function edit(Document $document)
    {
        return view('documents.edit', [
            'document' => $document,
            'pageTitle' => 'Edit Dokumen',
            'kategories' => ['Surat', 'Laporan', 'Peraturan', 'Pengumuman', 'Formulir', 'Lainnya']
        ]);
    }

    public function update(Request $request, Document $document)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'document' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:5120',
            'kategori' => 'nullable|string|max:100',
            'is_public' => 'required|boolean'
        ]);

        $data = [
            'judul' => $validated['judul'],
            'deskripsi' => $validated['deskripsi'],
            'kategori' => $validated['kategori'],
            'is_public' => $validated['is_public']
        ];

        if ($request->hasFile('document')) {
            Storage::delete($document->file_path);

            $file = $request->file('document');
            $filePath = $file->store('documents');
            $fileExtension = $file->getClientOriginalExtension();

            $data = array_merge($data, [
                'file_path' => $filePath,
                'file_name' => $file->getClientOriginalName(),
                'file_size' => $file->getSize(),
                'file_extension' => $fileExtension
            ]);
        }

        $document->update($data);

        return redirect()->route('admin.documents.index')
            ->with('success', 'Dokumen berhasil diperbarui!');
    }

    public function destroy(Document $document)
    {
        // Hapus file dari storage
        Storage::delete($document->file_path);
        
        // Hapus record dari database
        $document->delete();

        return redirect()->route('admin.documents.index')
            ->with('success', 'Dokumen berhasil dihapus!');
    }

    public function download(Document $document)
    {
        // Increment counter download
        $document->increment('download_count');
        
        return Storage::download($document->file_path, $document->file_name);
    }

    public function downloadAdmin(Document $document)
    {   
        return Storage::download($document->file_path, $document->file_name);
    }

    public function indexUser()
    {
        $query = Document::with('user')
                    ->where('is_public', true)
                    ->latest();

        // Filter by kategori
        if (request('kategori')) {
            $query->where('kategori', request('kategori'));
        }

        // Search
        if (request('search')) {
            $search = request('search');
            $query->where(function($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%");
            });
        }

        $documents = $query->paginate(12);
        $kategories = Document::where('is_public', true)
                        ->select('kategori')
                        ->whereNotNull('kategori')
                        ->distinct()
                        ->pluck('kategori');

        return view('user-views.documents', [
            'documents' => $documents,
            'kategories' => $kategories,
            'pageTitle' => 'Dokumen Publik'
        ]);
    }

    public function downloadUser(Document $document)
    {
        if (!$document->is_public) {
            abort(403);
        }

        if (!Storage::exists($document->file_path)) {
            abort(404, 'File tidak ditemukan');
        }

        $document->increment('download_count');
        
        return Storage::download($document->file_path, $document->file_name);
    }

    public function showUser(Document $document)
    {
        if (!$document->is_public) {
            abort(403);
        }

        return view('user-views.lihat-documents', [
            'document' => $document,
            'pageTitle' => $document->judul
        ]);
    }
}