<?php

namespace App\Http\Controllers;

use App\Models\Tugas;
use Illuminate\Http\Request;

class TugasController extends Controller
{
    public function index()
    {
        $tugas = Tugas::first();
        return view('tugas.index', ['pageTitle' => 'Tugas & Fungsi', 'tugas' => $tugas]);
    }

    public function create()
    {
        if (Tugas::first()) {
            return redirect()->route('admin.tugas.edit', Tugas::first()->id);
        }
        return view('tugas.create', ['pageTitle' => 'Tambah Tugas & Fungsi']);
    }

    public function store(Request $request)
    {
        $request->validate(['konten' => 'required|string']);
        Tugas::create($request->all());
        return redirect()->route('admin.tugas.index')->with('success', 'Tugas & Fungsi berhasil ditambahkan.');
    }

    public function edit(Tugas $tuga) 
    {
        return view('tugas.edit', ['pageTitle' => 'Edit Tugas & Fungsi', 'tugas' => $tuga]);
    }

    public function update(Request $request, Tugas $tuga)
    {
        $request->validate(['konten' => 'required|string']);
        $tuga->update($request->all());
        return redirect()->route('admin.tugas.index')->with('success', 'Tugas & Fungsi berhasil diperbarui.');
    }

    public function destroy(Tugas $tuga)
    {
        $tuga->delete();
        return redirect()->route('admin.tugas.index')->with('success', 'Tugas & Fungsi berhasil dihapus.');
    }

    public function showUser()
    {
        $tugas = Tugas::first();
        return view('user-views.tugas-fungsi', ['tugas' => $tugas]);
    }
}