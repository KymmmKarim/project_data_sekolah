@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-header">
            <h3 class="mb-0">Tambah Jadwal</h3>
        </div>

        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('jadwal.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="hari" class="form-label">Hari</label>
                    <input type="text" name="hari" class="form-control" placeholder="Contoh: Senin" required>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="jam_mulai" class="form-label">Jam Mulai</label>
                        <input type="time" name="jam_mulai" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="jam_selesai" class="form-label">Jam Selesai</label>
                        <input type="time" name="jam_selesai" class="form-control" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="kelas_id" class="form-label">Kelas</label>
                    <select name="kelas_id" class="form-select" required>
                        <option value="">-- Pilih Kelas --</option>
                        @foreach($kelas as $k)
                            <option value="{{ $k->id }}">{{ $k->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="pelajaran_id" class="form-label">Pelajaran</label>
                    <select name="pelajaran_id" class="form-select" required>
                        <option value="">-- Pilih Pelajaran --</option>
                        @foreach($pelajarans as $p)
                            <option value="{{ $p->id }}">{{ $p->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="guru_id" class="form-label">Guru</label>
                    <select name="guru_id" class="form-select" required>
                        <option value="">-- Pilih Guru --</option>
                        @foreach($gurus as $g)
                            <option value="{{ $g->id }}">{{ $g->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('jadwal.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection