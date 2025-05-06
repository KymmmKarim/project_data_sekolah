@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="mb-0">Data Siswa</h1>
        @can('tambah data')
            <a href="{{ route('siswa.create') }}" class="btn btn-primary">+ Tambah Siswa</a>
        @endcan
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-hover table-bordered mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Nama</th>
                        <th>NISN</th>
                        <th>Kelas</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($siswas as $siswa)
                        <tr>
                            <td>{{ $siswa->nama }}</td>
                            <td>{{ $siswa->nisn }}</td>
                            <td>{{ $siswa->kelas }}</td>
                            <td class="text-center">
                                @can('edit data')
                                    <a href="{{ route('siswa.edit', $siswa->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                @endcan
                                @can('hapus data')
                                    <form action="{{ route('siswa.destroy', $siswa->id) }}" method="POST" style="display:inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="return confirm('Yakin hapus?')" class="btn btn-sm btn-danger">Hapus</button>
                                    </form>
                                @endcan
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">Belum ada data siswa.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection