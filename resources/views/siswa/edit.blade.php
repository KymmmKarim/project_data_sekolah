@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">Edit Data Siswa</div>
        <div class="card-body">

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $e)
                            <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('siswa.update', $siswa->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label>Nama</label>
                    <input type="text" name="nama" value="{{ $siswa->nama }}" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>NISN</label>
                    <input type="text" name="nisn" value="{{ $siswa->nisn }}" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Kelas</label>
                    <input type="text" name="kelas" value="{{ $siswa->kelas }}" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Foto (boleh dikosongkan jika tidak ingin ganti)</label>
                    <input type="file" name="foto" class="form-control">

                    @if($siswa->foto)
                        <img src="{{ asset('storage/foto/' . $siswa->foto) }}" width="150" class="mt-2">
                    @endif
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('siswa.index') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-success">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
