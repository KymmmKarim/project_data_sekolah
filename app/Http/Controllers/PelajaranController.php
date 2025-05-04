<?php

namespace App\Http\Controllers;

use App\Models\Pelajaran;
use Illuminate\Http\Request;

class PelajaranController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $this->authorize('lihat data');
        $pelajarans = Pelajaran::all();
        return view('pelajaran.index', compact('pelajarans'));
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

        Pelajaran::create($request->all());
        return redirect()->route('pelajaran.index')->with('success', 'Pelajaran berhasil ditambahkan.');
    }

    public function edit(Pelajaran $pelajaran)
    {
        $this->authorize('edit data');
        return view('pelajaran.edit', compact('pelajaran'));
    }

    public function update(Request $request, Pelajaran $pelajaran)
    {
        $this->authorize('edit data');

        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        $pelajaran->update($request->all());
        return redirect()->route('pelajaran.index')->with('success', 'Pelajaran berhasil diupdate.');
    }

    public function destroy(Pelajaran $pelajaran)
    {
        $this->authorize('hapus data');

        $pelajaran->delete();
        return redirect()->route('pelajaran.index')->with('success', 'Pelajaran berhasil dihapus.');
    }
}