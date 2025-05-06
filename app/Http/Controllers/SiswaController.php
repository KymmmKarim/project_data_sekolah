<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

            'nama' => 'required',
            'nisn' => 'required|unique:siswas',
            'kelas' => 'required',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/foto', $filename);
            $data['foto'] = 'storage/foto/' . $filename;
        }

        Siswa::create($data);([

            'nama'  => 'required',
            'nisn'  => 'required|unique:siswas',
            'kelas' => 'required',
        ]);

        Siswa::create($request->all());


        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil ditambahkan.');
    }


    public function show(Siswa $siswa)
    {
        // bisa diisi jika kamu ingin menampilkan detail siswa
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

            'nama' => 'required',
            'nisn' => 'required|unique:siswas,nisn,' . $siswa->id,
            'kelas' => 'required',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($siswa->foto && Storage::exists(str_replace('storage/', 'public/', $siswa->foto))) {
                Storage::delete(str_replace('storage/', 'public/', $siswa->foto));
            }

            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/foto', $filename);
            $data['foto'] = 'storage/foto/' . $filename;
        }

        $siswa->update($data);([

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


        // Hapus foto dari storage jika ada
        if ($siswa->foto && Storage::exists(str_replace('storage/', 'public/', $siswa->foto))) {
            Storage::delete(str_replace('storage/', 'public/', $siswa->foto));
        }


        $siswa->delete();

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil dihapus.');
    }
}
