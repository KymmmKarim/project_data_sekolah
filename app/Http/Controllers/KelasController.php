<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index()
    {
        $this->authorize('lihat data');
        $kelas = Kelas::all();
        return view('kelas.index', compact('kelas'));
    }

    public function create()
    {
        $this->authorize('tambah data');
        return view('kelas.create');
    }

    public function store(Request $request)
    {
        $this->authorize('tambah data');
        $request->validate([
            'nama' => 'required|unique:kelas'
        ]);
        Kelas::create($request->all());
        return redirect()->route('kelas.index')->with('success', 'Data kelas berhasil ditambahkan.');
    }

    public function edit(Kelas $kelas)
    {
        $this->authorize('edit data');
        return view('kelas.edit', compact('kelas'));
    }

    public function update(Request $request, Kelas $kelas)
    {
        $this->authorize('edit data');
        $request->validate([
            'nama' => 'required|unique:kelas,nama,' . $kelas->id
        ]);
        $kelas->update($request->all());
        return redirect()->route('kelas.index')->with('success', 'Data kelas berhasil diperbarui.');
    }

    public function destroy(Kelas $kelas)
    {
        $this->authorize('hapus data');
        $kelas->delete();
        return redirect()->route('kelas.index')->with('success', 'Data kelas berhasil dihapus.');
    }
}