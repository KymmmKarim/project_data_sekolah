@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow-sm rounded">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Tambah Data Siswa</h4>
        </div>
        <div class="card-body">
        <form method="POST" action="{{ route('guru.store') }}">
    @csrf
    <input type="text" name="name" placeholder="Nama Guru">
    <input type="email" name="email" placeholder="Email Guru">
    
    <input type="text" name="pelajarans[]" placeholder="Pelajaran 1">
    <input type="text" name="pelajarans[]" placeholder="Pelajaran 2">
    <input type="text" name="pelajarans[]" placeholder="Pelajaran 3">

    <button type="submit">Simpan</button>
</form>

            @if($errors->any())
                <div class="alert alert-danger">
                    <strong>Periksa kembali data yang Anda masukkan:</strong>
                    <ul class="mb-0 mt-2">
                        @foreach($errors->all() as $e)
                            <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
<form method="POST" action="{{ route('guru.store') }}">
    @csrf
    <input type="text" name="name" placeholder="Nama Guru">
    <input type="email" name="email" placeholder="Email Guru">
    
    <input type="text" name="pelajarans[]" placeholder="Pelajaran 1">
    <input type="text" name="pelajarans[]" placeholder="Pelajaran 2">
    <input type="text" name="pelajarans[]" placeholder="Pelajaran 3">

    <button type="submit">Simpan</button>
</form>

            {{-- 🛠️ Tambahkan enctype agar file bisa dikirim --}}
            <form action="{{ route('siswa.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Siswa</label>
                    <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukkan nama siswa" required>
                </div>

                <div class="mb-3">
                    <label for="nisn" class="form-label">NISN</label>
                    <input type="text" name="nisn" id="nisn" class="form-control" placeholder="Masukkan NISN siswa" required>
                </div>

                <div class="mb-3">
                    <label for="kelas" class="form-label">Kelas</label>
                    <input type="text" name="kelas" id="kelas" class="form-control" placeholder="Contoh: X IPA 1" required>
                </div>

                {{-- 🔽 Input untuk Upload Foto --}}
                <div class="mb-3">
                    <label for="foto" class="form-label">Foto Siswa</label>
                    <input type="file" name="foto" id="foto" class="form-control" accept="image/*">
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('siswa.index') }}" class="btn btn-outline-secondary">Kembali</a>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
