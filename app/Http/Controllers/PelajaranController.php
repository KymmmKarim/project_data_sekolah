<?php

namespace App\Http\Controllers;

use App\Models\Pelajaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PelajaranController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $this->authorize('lihat data');

        $data = [
            'pelajarans' => Pelajaran::all(),
        ];

        return view('pelajaran.index', $data);
    }

    public function create()
    {
        $this->authorize('tambah data');

        return view('pelajaran.create');
    }

    public function store(Request $request)
    {
        $this->authorize('tambah data');

        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        DB::beginTransaction();

        try {
            Pelajaran::create($request->all());

            DB::commit();

            return redirect()->route('pelajaran.index')->with('success', 'Pelajaran berhasil ditambahkan.');
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Terjadi kesalahan saat menambahkan pelajaran.'])->withInput();
        }
    }

    public function edit(Pelajaran $pelajaran)
    {
        $this->authorize('edit data');

        $data = [
            'pelajaran' => $pelajaran,
        ];

        return view('pelajaran.edit', $data);
    }

    public function update(Request $request, Pelajaran $pelajaran)
    {
        $this->authorize('edit data');

        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        DB::beginTransaction();

        try {
            $pelajaran->update($request->all());

            DB::commit();

            return redirect()->route('pelajaran.index')->with('success', 'Pelajaran berhasil diupdate.');
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Terjadi kesalahan saat memperbarui pelajaran.'])->withInput();
        }
    }

    public function destroy(Pelajaran $pelajaran)
    {
        $this->authorize('hapus data');

        DB::beginTransaction();

        try {
            $pelajaran->delete();

            DB::commit();

            return redirect()->route('pelajaran.index')->with('success', 'Pelajaran berhasil dihapus.');
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Terjadi kesalahan saat menghapus pelajaran.']);
        }
    }
}
