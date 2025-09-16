<?php

namespace App\Http\Controllers;

use App\Models\Sejarah;
use Illuminate\Http\Request;

class SejarahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sejarah = Sejarah::first();
        return view('sejarah.index', [
            'pageTitle' => 'Sejarah',
            'sejarah' => $sejarah
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Jika sudah ada data, redirect ke halaman edit.
        $sejarah = Sejarah::first();
        if ($sejarah) {
            return redirect()->route('admin.sejarah.edit', $sejarah->id);
        }

        return view('sejarah.create', ['pageTitle' => 'Tambah Sejarah']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'konten' => 'required|string',
        ]);

        Sejarah::create($request->all());

        return redirect()->route('admin.sejarah.index')
                         ->with('success', 'Sejarah berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sejarah $sejarah)
    {
        return view('sejarah.edit', [
            'pageTitle' => 'Edit Sejarah',
            'sejarah' => $sejarah
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sejarah $sejarah)
    {
        $request->validate([
            'konten' => 'required|string',
        ]);

        $sejarah->update($request->all());

        return redirect()->route('admin.sejarah.index')
                         ->with('success', 'Sejarah berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sejarah $sejarah)
    {
        $sejarah->delete();

        return redirect()->route('admin.sejarah.index')
                         ->with('success', 'Sejarah berhasil dihapus.');
    }

    public function showUser()
    {
        $sejarah = Sejarah::first();
        
        return view('user-views.sejarah', [
            'sejarah' => $sejarah
        ]);
    }
}
