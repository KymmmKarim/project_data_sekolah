@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="mb-0">Data Jadwal</h3>
            @can('tambah data')
            <a href="{{ route('jadwal.create') }}" class="btn btn-primary">+ Tambah Jadwal</a>
            @endcan
        </div>

        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="table-dark">
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
                        @forelse($jadwals as $j)
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
                                <form action="{{ route('jadwal.destroy', $j->id) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Yakin hapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                                @endcan
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">Tidak ada data jadwal.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection