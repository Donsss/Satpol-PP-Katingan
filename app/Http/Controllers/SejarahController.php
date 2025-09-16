<?php

namespace App\Http\Controllers;

use App\Models\Sejarah;
use Illuminate\Http\Request;

class SejarahController extends Controller
{
    public function index()
    {
        $sejarah = Sejarah::first();
        return view('sejarah.index', [
            'pageTitle' => 'Sejarah',
            'sejarah' => $sejarah
        ]);
    }

    public function create()
    {
        // Jika sudah ada data, redirect ke halaman edit.
        $sejarah = Sejarah::first();
        if ($sejarah) {
            return redirect()->route('admin.sejarah.edit', $sejarah->id);
        }

        return view('sejarah.create', ['pageTitle' => 'Tambah Sejarah']);
    }

    public function store(Request $request)
    {
        $request->validate([
            'konten' => 'required|string',
        ]);

        Sejarah::create($request->all());

        return redirect()->route('admin.sejarah.index')
                         ->with('success', 'Sejarah berhasil ditambahkan.');
    }

    public function edit(Sejarah $sejarah)
    {
        return view('sejarah.edit', [
            'pageTitle' => 'Edit Sejarah',
            'sejarah' => $sejarah
        ]);
    }

    public function update(Request $request, Sejarah $sejarah)
    {
        $request->validate([
            'konten' => 'required|string',
        ]);

        $sejarah->update($request->all());

        return redirect()->route('admin.sejarah.index')
                         ->with('success', 'Sejarah berhasil diperbarui.');
    }

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
