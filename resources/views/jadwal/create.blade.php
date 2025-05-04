@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Data Jadwal</h1>

    @can('tambah data')
    <a href="{{ route('jadwal.create') }}" class="btn btn-primary mb-3">+ Tambah Jadwal</a>
    @endcan

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Hari</th>
                <th>Jam</th>
                <th>Kelas</th>
                <th>Pelajaran</th>
                <th>Guru</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($jadwals as $j)
            <tr>
                <td>{{ $j->hari }}</td>
                <td>{{ $j->jam_mulai }} - {{ $j->jam_selesai }}</td>
                <td>{{ $j->kelas->nama }}</td>
                <td>{{ $j->pelajaran->nama }}</td>
                <td>{{ $j->guru->name }}</td>
                <td>
                    @can('edit data')
                    <a href="{{ route('jadwal.edit', $j->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    @endcan
                    @can('hapus data')
                    <form action="{{ route('jadwal.destroy', $j->id) }}" method="POST" style="display:inline-block">
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