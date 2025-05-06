<?php

namespace App\Http\Controllers;


use App\Models\Guru;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    public function create()
    {
        return view('guru.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:gurus,email',
            'pelajarans' => 'required|array|min:1',
            'pelajarans.*' => 'required|string|max:255',
        ]);

        $guru = Guru::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);

        foreach ($validated['pelajarans'] as $pelajaranName) {
            $guru->pelajarans()->create(['nama' => $pelajaranName]);
        }

        return redirect()->back()->with('success', 'Guru dan pelajaran berhasil disimpan!');
    }
}
