<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KelasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $this->authorize('lihat data');

        $data = [
            'kelas' => Kelas::all(),
        ];

        return view('kelas.index', $data);
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
            'nama' => 'required|unique:kelas',
        ]);

        DB::beginTransaction();

        try {
            Kelas::create([
                'nama' => $request->nama,
            ]);

            DB::commit();

            return redirect()->route('kelas.index')->with('success', 'Data kelas berhasil ditambahkan.');
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Terjadi kesalahan saat menambahkan data kelas.'])->withInput();
        }
    }

    public function edit(Kelas $kelas)
    {
        $this->authorize('edit data');

        $data = [
            'kelas' => $kelas,
        ];

        return view('kelas.edit', $data);
    }

    public function update(Request $request, Kelas $kelas)
    {
        $this->authorize('edit data');

        $request->validate([
            'nama' => 'required|unique:kelas,nama,' . $kelas->id,
        ]);

        DB::beginTransaction();

        try {
            $kelas->update([
                'nama' => $request->nama,
            ]);

            DB::commit();

            return redirect()->route('kelas.index')->with('success', 'Data kelas berhasil diperbarui.');
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Terjadi kesalahan saat memperbarui data kelas.'])->withInput();
        }
    }

    public function destroy(Kelas $kelas)
    {
        $this->authorize('hapus data');

        DB::beginTransaction();

        try {
            $kelas->delete();

            DB::commit();

            return redirect()->route('kelas.index')->with('success', 'Data kelas berhasil dihapus.');
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Terjadi kesalahan saat menghapus data kelas.']);
        }
    }
}
