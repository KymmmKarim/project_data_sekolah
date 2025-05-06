@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Guru dan Mata Pelajaran</h1>

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
            <label for="name">Nama Guru</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
        </div>

        <div class="form-group">
            <label for="email">Email Guru</label>
            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
        </div>

        <hr>

        <div class="form-group">
            <label for="subjects[]">Mata Pelajaran 1</label>
            <input type="text" name="subjects[]" class="form-control" value="{{ old('subjects.0') }}" required>
        </div>

        <div class="form-group">
            <label for="subjects[]">Mata Pelajaran 2</label>
            <input type="text" name="subjects[]" class="form-control" value="{{ old('subjects.1') }}" required>
        </div>

        <div class="form-group">
            <label for="subjects[]">Mata Pelajaran 3</label>
            <input type="text" name="subjects[]" class="form-control" value="{{ old('subjects.2') }}" required>
        </div>

        <button type="submit" class="btn btn-success mt-2">Simpan</button>
        <a href="{{ route('pelajaran.index') }}" class="btn btn-secondary mt-2">Kembali</a>
    </form>
</div>
@endsection
