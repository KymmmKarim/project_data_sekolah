@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Siswa</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('siswa.update', $siswa->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" value="{{ $siswa->nama }}" required>
        </div>
        <div class="mb-3">
            <label>NISN</label>
            <input type="text" name="nisn" class="form-control" value="{{ $siswa->nisn }}" required>
        </div>
        <div class="mb-3">
            <label>Kelas</label>
            <input type="text" name="kelas" class="form-control" value="{{ $siswa->kelas }}" required>
        </div>
        <button class="btn btn-success">Update</button>
        <a href="{{ route('siswa.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
