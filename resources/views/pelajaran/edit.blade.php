@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Pelajaran</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pelajaran.update', $pelajaran->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nama">Nama Pelajaran</label>
            <input type="text" name="nama" class="form-control" value="{{ $pelajaran->nama }}" required>
        </div>
        <button type="submit" class="btn btn-primary mt-2">Update</button>
        <a href="{{ route('pelajaran.index') }}" class="btn btn-secondary mt-2">Kembali</a>
    </form>
</div>
@endsection