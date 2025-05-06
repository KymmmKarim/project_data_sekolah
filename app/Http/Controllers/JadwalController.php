<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Kelas;
use App\Models\Pelajaran;
use App\Models\User;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $this->authorize('lihat data');

        $data = [
            'jadwals' => Jadwal::with(['kelas', 'pelajaran', 'guru'])->get(),
        ];

        return view('jadwal.index', $data);
    }

    public function create()
    {
        $this->authorize('tambah data');

        $data = [
            'kelas'      => Kelas::all(),
            'pelajarans' => Pelajaran::all(),
            'gurus'      => User::role('guru')->get(),
        ];

        return view('jadwal.create', $data);
    }

    public function store(Request $request)
    {
        $this->authorize('tambah data');

        $request->validate([
            'hari'         => 'required|string',
            'jam_mulai'    => 'required',
            'jam_selesai'  => 'required',
            'kelas_id'     => 'required|exists:kelas,id',
            'pelajaran_id' => 'required|exists:pelajarans,id',
            'guru_id'      => 'required|exists:users,id',
        ]);

        Jadwal::create($request->all());

        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil ditambahkan.');
    }

    public function edit(Jadwal $jadwal)
    {
        $this->authorize('edit data');

        $data = [
            'jadwal'     => $jadwal,
            'kelas'      => Kelas::all(),
            'pelajarans' => Pelajaran::all(),
            'gurus'      => User::role('guru')->get(),
        ];

        return view('jadwal.edit', $data);
    }

    public function update(Request $request, Jadwal $jadwal)
    {
        $this->authorize('edit data');

        $request->validate([
            'hari'         => 'required|string',
            'jam_mulai'    => 'required',
            'jam_selesai'  => 'required',
            'kelas_id'     => 'required|exists:kelas,id',
            'pelajaran_id' => 'required|exists:pelajarans,id',
            'guru_id'      => 'required|exists:users,id',
        ]);

        $jadwal->update($request->all());

        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil diperbarui.');
    }

    public function destroy(Jadwal $jadwal)
    {
        $this->authorize('hapus data');

        $jadwal->delete();

        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil dihapus.');
    }
}
