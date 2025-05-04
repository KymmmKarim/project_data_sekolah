@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Pelajaran</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pelajaran.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nama">Nama Pelajaran</label>
            <input type="text" name="nama" class="form-control" value="{{ old('nama') }}" required>
        </div>
        <button type="submit" class="btn btn-success mt-2">Simpan</button>
        <a href="{{ route('pelajaran.index') }}" class="btn btn-secondary mt-2">Kembali</a>
    </form>
</div>
@endsection