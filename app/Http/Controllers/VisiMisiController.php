<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\VisiMisi;
use Illuminate\Http\Request;

class VisiMisiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $visiMisi = VisiMisi::first();
        return view('visi-misi.index', [
            'pageTitle' => 'Visi & Misi',
            'visiMisi' => $visiMisi
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Cek jika sudah ada data, redirect ke halaman edit saja.
        $visiMisi = VisiMisi::first();
        if ($visiMisi) {
            return redirect()->route('admin.visi-misi.edit', $visiMisi->id);
        }

        return view('visi-misi.create', ['pageTitle' => 'Tambah Visi & Misi']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'visi' => 'required|string',
            'misi' => 'required|string',
        ]);

        VisiMisi::create($request->all());

        return redirect()->route('admin.visi-misi.index')
                         ->with('success', 'Visi & Misi berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(VisiMisi $visiMisi)
    {
        return view('visi-misi.edit', [
            'pageTitle' => 'Edit Visi & Misi',
            'visiMisi' => $visiMisi
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, VisiMisi $visiMisi)
    {
        $request->validate([
            'visi' => 'required|string',
            'misi' => 'required|string',
        ]);

        $visiMisi->update($request->all());

        return redirect()->route('admin.visi-misi.index')
                         ->with('success', 'Visi & Misi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VisiMisi $visiMisi)
    {
        $visiMisi->delete();

        return redirect()->route('admin.visi-misi.index')
                         ->with('success', 'Visi & Misi berhasil dihapus.');
    }

    public function showUser()
    {
        // Ambil data Visi & Misi yang pertama (dan satu-satunya) dari database.
        $visiMisi = VisiMisi::first();

        // Kirim data ke view 'user.visi-misi.index'
        return view('user-views.visi-misi', [
            'visiMisi' => $visiMisi
        ]);
    }
}