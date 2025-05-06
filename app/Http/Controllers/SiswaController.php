<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index()
    {
        $this->authorize('lihat data');

        $data = [
            'siswas' => Siswa::all(),
        ];

        return view('siswa.index', $data);
    }

    public function create()
    {
        $this->authorize('tambah data');

        return view('siswa.create');
    }

    public function store(Request $request)
    {
        $this->authorize('tambah data');

        $request->validate([
            'nama'  => 'required',
            'nisn'  => 'required|unique:siswas',
            'kelas' => 'required',
        ]);

        Siswa::create($request->all());

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil ditambahkan.');
    }

    public function edit(Siswa $siswa)
    {
        $this->authorize('edit data');

        $data = [
            'siswa' => $siswa,
        ];

        return view('siswa.edit', $data);
    }

    public function update(Request $request, Siswa $siswa)
    {
        $this->authorize('edit data');

        $request->validate([
            'nama'  => 'required',
            'nisn'  => 'required|unique:siswas,nisn,' . $siswa->id,
            'kelas' => 'required',
        ]);

        $siswa->update($request->all());

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil diperbarui.');
    }

    public function destroy(Siswa $siswa)
    {
        $this->authorize('hapus data');

        $siswa->delete();

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil dihapus.');
    }
}
