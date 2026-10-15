<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Persyaratan;
use Illuminate\Http\Request;

class PersyaratanController extends Controller
{
    public function index()
    {
        $persyaratans = Persyaratan::orderBy('urutan')->get();
        return view('admin.persyaratan.index', compact('persyaratans'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul'      => 'required|string|max:255',
            'keterangan' => 'nullable|string',
            'urutan'     => 'nullable|integer',
        ]);

        Persyaratan::create($validated);

        return back()->with('sukses', 'Persyaratan berhasil ditambahkan.');
    }

    public function update(Request $request, Persyaratan $persyaratan)
    {
        $validated = $request->validate([
            'judul'      => 'required|string|max:255',
            'keterangan' => 'nullable|string',
            'urutan'     => 'nullable|integer',
        ]);

        $persyaratan->update($validated);

        return back()->with('sukses', 'Persyaratan berhasil diperbarui.');
    }

    public function destroy(Persyaratan $persyaratan)
    {
        $persyaratan->delete();
        return back()->with('sukses', 'Persyaratan berhasil dihapus.');
    }
}
