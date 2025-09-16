<?php
namespace App\Http\Controllers;

use App\Models\OrganizationalStructure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OrganizationalStructureController extends Controller
{
    public function index()
    {
        $structures = OrganizationalStructure::orderBy('section')
            ->orderBy('order')
            ->get();

        $groupedStructures = $structures->groupBy('section');

        return view('struktur-organisasi.index', compact('groupedStructures'));
    }

    public function showForUser()
    {
        $structures = OrganizationalStructure::orderBy('section')
            ->orderBy('order')
            ->get();

        $groupedStructures = $structures->groupBy('section');

        return view('user-views.struktur-organisasi', compact('groupedStructures'));
    }

    public function create()
    {
        $parents = OrganizationalStructure::all();
        return view('struktur-organisasi.create', compact('parents'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'nip' => 'nullable|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5048',
            'section' => 'required|integer|min:1',
            'order' => 'required|integer|min:1',

        ]);

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('organizational-photos', 'public');
            $validated['photo'] = $photoPath;
        }

        OrganizationalStructure::create($validated);

        return redirect()->route('admin.organisasi.index')
            ->with('success', 'Struktur organisasi berhasil ditambahkan');
    }

    public function edit(OrganizationalStructure $organizationalStructure)
    {
        $parents = OrganizationalStructure::where('id', '!=', $organizationalStructure->id)->get();
        return view('struktur-organisasi.edit', compact('organizationalStructure', 'parents'));
    }

    public function update(Request $request, OrganizationalStructure $organizationalStructure)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'nip' => 'nullable|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5048',
            'section' => 'required|integer|min:1',
            'order' => 'required|integer|min:1',
        ]);

        if ($request->hasFile('photo')) {
            if ($organizationalStructure->photo) {
                Storage::disk('public')->delete($organizationalStructure->photo);
            }
            
            $photoPath = $request->file('photo')->store('organizational-photos', 'public');
            $validated['photo'] = $photoPath;
        }

        $organizationalStructure->update($validated);

        return redirect()->route('admin.organisasi.index')
            ->with('success', 'Struktur organisasi berhasil diperbarui');
    }

    public function destroy(OrganizationalStructure $organizationalStructure)
    {
        if ($organizationalStructure->photo) {
            Storage::disk('public')->delete($organizationalStructure->photo);
        }

        foreach ($organizationalStructure->children as $child) {
            $child->delete();
        }

        $organizationalStructure->delete();

        return redirect()->route('admin.organisasi.index')
            ->with('success', 'Struktur organisasi berhasil dihapus');
    }
}