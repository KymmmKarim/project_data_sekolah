<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Kelas;
use App\Models\Pelajaran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            'jadwals' => 'required|array|min:1',
            'jadwals.*.hari'         => 'required|string',
            'jadwals.*.jam_mulai'    => 'required',
            'jadwals.*.jam_selesai'  => 'required',
            'jadwals.*.kelas_id'     => 'required|exists:kelas,id',
            'jadwals.*.pelajaran_id' => 'required|exists:pelajarans,id',
            'jadwals.*.guru_id'      => 'required|exists:users,id',
        ]);

        $errors = [];

        foreach ($request->jadwals as $index => $data) {
            $hari = strtolower(trim($data['hari']));
            $exists = Jadwal::whereRaw('LOWER(hari) = ?', [$hari])
                ->where('kelas_id', $data['kelas_id'])
                ->where('pelajaran_id', $data['pelajaran_id'])
                ->where('guru_id', $data['guru_id'])
                ->exists();

            if ($exists) {
                $errors[] = "Jadwal ke-" . ($index + 1) . ": Kombinasi hari, pelajaran, dan kelas untuk guru ini sudah ada.";
            }
        }

        if (count($errors) > 0) {
            return back()->withErrors($errors)->withInput();
        }

        try {
            DB::beginTransaction();

            foreach ($request->jadwals as $data) {
                $data['hari'] = strtolower(trim($data['hari']));
                Jadwal::create($data);
            }

            DB::commit();
            return redirect()->route('jadwal.index')->with('success', 'Semua jadwal berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['Terjadi kesalahan saat menyimpan: ' . $e->getMessage()])->withInput();
        }
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

        $hari = strtolower(trim($request->hari));

        $exists = Jadwal::where('id', '!=', $jadwal->id)
            ->whereRaw('LOWER(hari) = ?', [$hari])
            ->where('kelas_id', $request->kelas_id)
            ->where('pelajaran_id', $request->pelajaran_id)
            ->where('guru_id', $request->guru_id)
            ->exists();

        if ($exists) {
            return back()->withErrors(['Jadwal dengan kombinasi tersebut sudah ada untuk guru ini.'])->withInput();
        }

        try {
            DB::beginTransaction();

            $jadwal->update([
                'hari'         => $hari,
                'jam_mulai'    => $request->jam_mulai,
                'jam_selesai'  => $request->jam_selesai,
                'kelas_id'     => $request->kelas_id,
                'pelajaran_id' => $request->pelajaran_id,
                'guru_id'      => $request->guru_id,
            ]);

            DB::commit();
            return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['Terjadi kesalahan saat update: ' . $e->getMessage()])->withInput();
        }
    }

    public function destroy(Jadwal $jadwal)
    {
        $this->authorize('hapus data');

        try {
            DB::beginTransaction();

            $jadwal->delete();

            DB::commit();
            return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['Terjadi kesalahan saat menghapus: ' . $e->getMessage()]);
        }
    }
}
