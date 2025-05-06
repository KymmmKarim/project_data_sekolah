@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Data Pelajaran</h1>
    
    @can('tambah data')
        <a href="{{ route('pelajaran.create') }}" class="btn btn-primary mb-3">+ Tambah Pelajaran</a>
    @endcan

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Pelajaran</th>
                @canany(['edit data', 'hapus data'])
                <th>Aksi</th>
                @endcanany
            </tr>
        </thead>
        <tbody>
            @foreach($pelajarans as $pelajaran)
            <tr>
                <td>{{ $pelajaran->nama }}</td>
                @canany(['edit data', 'hapus data'])
                <td>
                    @can('edit data')
                    <a href="{{ route('pelajaran.edit', $pelajaran->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    @endcan

                    @can('hapus data')
                    <form action="{{ route('pelajaran.destroy', $pelajaran->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                    </form>
                    @endcan
                </td>
                @endcanany
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection