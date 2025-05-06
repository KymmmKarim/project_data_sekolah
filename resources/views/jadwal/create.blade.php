@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tambah Jadwal</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('jadwal.store') }}" method="POST">
        @csrf

        <table class="table table-bordered" id="jadwal-table">
            <thead>
                <tr>
                    <th>Hari</th>
                    <th>Jam Mulai</th>
                    <th>Jam Selesai</th>
                    <th>Kelas</th>
                    <th>Pelajaran</th>
                    <th>Guru</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><input type="text" name="jadwals[0][hari]" class="form-control" required></td>
                    <td><input type="time" name="jadwals[0][jam_mulai]" class="form-control" required></td>
                    <td><input type="time" name="jadwals[0][jam_selesai]" class="form-control" required></td>
                    <td>
                        <select name="jadwals[0][kelas_id]" class="form-control" required>
                            <option value="">-- Pilih Kelas --</option>
                            @foreach ($kelas as $k)
                                <option value="{{ $k->id }}">{{ $k->nama }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select name="jadwals[0][pelajaran_id]" class="form-control" required>
                            <option value="">-- Pilih Pelajaran --</option>
                            @foreach ($pelajarans as $p)
                                <option value="{{ $p->id }}">{{ $p->nama }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select name="jadwals[0][guru_id]" class="form-control" required>
                            <option value="">-- Pilih Guru --</option>
                            @foreach ($gurus as $g)
                                <option value="{{ $g->id }}">{{ $g->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td><button type="button" class="btn btn-danger btn-sm remove-row">Hapus</button></td>
                </tr>
            </tbody>
        </table>

        <button type="button" id="add-row" class="btn btn-primary">+ Tambah Baris</button>
        <br><br>
        <button type="submit" class="btn btn-success">Simpan Semua</button>
        <a href="{{ route('jadwal.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection

@section('scripts')
<script>
    let rowIdx = 1;

    document.getElementById('add-row').addEventListener('click', function () {
        let tbody = document.querySelector('#jadwal-table tbody');
        let newRow = document.createElement('tr');

        newRow.innerHTML = `
            <td><input type="text" name="jadwals[${rowIdx}][hari]" class="form-control" required></td>
            <td><input type="time" name="jadwals[${rowIdx}][jam_mulai]" class="form-control" required></td>
            <td><input type="time" name="jadwals[${rowIdx}][jam_selesai]" class="form-control" required></td>
            <td>
                <select name="jadwals[${rowIdx}][kelas_id]" class="form-control" required>
                    <option value="">-- Pilih Kelas --</option>
                    @foreach ($kelas as $k)
                        <option value="{{ $k->id }}">{{ $k->nama }}</option>
                    @endforeach
                </select>
            </td>
            <td>
                <select name="jadwals[${rowIdx}][pelajaran_id]" class="form-control" required>
                    <option value="">-- Pilih Pelajaran --</option>
                    @foreach ($pelajarans as $p)
                        <option value="{{ $p->id }}">{{ $p->nama }}</option>
                    @endforeach
                </select>
            </td>
            <td>
                <select name="jadwals[${rowIdx}][guru_id]" class="form-control" required>
                    <option value="">-- Pilih Guru --</option>
                    @foreach ($gurus as $g)
                        <option value="{{ $g->id }}">{{ $g->name }}</option>
                    @endforeach
                </select>
            </td>
            <td><button type="button" class="btn btn-danger btn-sm remove-row">Hapus</button></td>
        `;

        tbody.appendChild(newRow);
        rowIdx++;
    });

    document.addEventListener('click', function (e) {
        if (e.target && e.target.matches('button.remove-row')) {
            e.target.closest('tr').remove();
        }
    });
</script>
@endsection
