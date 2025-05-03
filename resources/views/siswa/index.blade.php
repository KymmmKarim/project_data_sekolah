@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Data Siswa</h1>

    @can('tambah data')
        <a href="{{ route('siswa.create') }}" class="btn btn-primary mb-3">+ Tambah Siswa</a>
    @endcan

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama</th>
                <th>NISN</th>
                <th>Kelas</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($siswas as $siswa)
            <tr>
                <td>{{ $siswa->nama }}</td>
                <td>{{ $siswa->nisn }}</td>
                <td>{{ $siswa->kelas }}</td>
                <td>
                    @can('edit data')
                        <a href="{{ route('siswa.edit', $siswa->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    @endcan
                    @can('hapus data')
                        <form action="{{ route('siswa.destroy', $siswa->id) }}" method="POST" style="display:inline-block">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Yakin hapus?')" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    @endcan
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
