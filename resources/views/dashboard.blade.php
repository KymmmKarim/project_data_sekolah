@extends('layouts.app')

@section('content')
<div class="text-center mb-10">
    <h1 class="text-4xl font-extrabold text-gray-800 mb-3">🎓 Portal Informasi Data Sekolah</h1>
    <p class="text-lg text-gray-600">Kelola seluruh informasi sekolah.</p>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
    <div class="bg-gradient-to-br from-blue-50 to-white rounded-2xl shadow-lg p-6 hover:scale-105 transform transition duration-300">
        <div class="flex items-center mb-3">
            <i class="fas fa-user-graduate text-blue-600 text-3xl mr-3"></i>
            <h2 class="text-xl font-semibold text-blue-700">Data Siswa</h2>
        </div>
        <p class="text-sm text-gray-600 mb-4">Lihat dan kelola seluruh data siswa secara detail.</p>
        <button><a href="{{ route('siswa.index') }}" class="inline-block text-sm text-white bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 px-4 py-2 rounded shadow">
            Kelola Siswa
        </a></button>
    </div>

    <div class="bg-gradient-to-br from-green-50 to-white rounded-2xl shadow-lg p-6 hover:scale-105 transform transition duration-300">
        <div class="flex items-center mb-3">
            <i class="fas fa-chalkboard-teacher text-green-600 text-3xl mr-3"></i>
            <h2 class="text-xl font-semibold text-green-700">Data Kelas</h2>
        </div>
        <p class="text-sm text-gray-600 mb-4">Atur struktur kelas dan jumlah siswa per kelas.</p>
        <button><a href="{{ route('kelas.index') }}" class="inline-block text-sm text-white bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 px-4 py-2 rounded shadow">
            Kelola Kelas
        </a></button>
    </div>

    <div class="bg-gradient-to-br from-purple-50 to-white rounded-2xl shadow-lg p-6 hover:scale-105 transform transition duration-300">
        <div class="flex items-center mb-3">
            <i class="fas fa-book text-purple-600 text-3xl mr-3"></i>
            <h2 class="text-xl font-semibold text-purple-700">Data Pelajaran</h2>
        </div>
        <p class="text-sm text-gray-600 mb-4">Organisasi mata pelajaran untuk tiap tingkatan kelas.</p>
        <button><a href="{{ route('pelajaran.index') }}" class="inline-block text-sm text-white bg-gradient-to-r from-purple-600 to-purple-700 hover:from-purple-700 hover:to-purple-800 px-4 py-2 rounded shadow">
            Kelola Pelajaran
        </a></button>
    </div>

    <div class="bg-gradient-to-br from-red-50 to-white rounded-2xl shadow-lg p-6 hover:scale-105 transform transition duration-300">
        <div class="flex items-center mb-3">
            <i class="fas fa-calendar-alt text-red-600 text-3xl mr-3"></i>
            <h2 class="text-xl font-semibold text-red-700">Jadwal Mengajar</h2>
        </div>
        <p class="text-sm text-gray-600 mb-4">Susun dan pantau jadwal pelajaran dengan mudah.</p>
        <button><a href="{{ route('jadwal.index') }}" class="inline-block text-sm text-white bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 px-4 py-2 rounded shadow">
            Kelola Jadwal
        </a></button>
    </div>
</div>

<footer class="mt-10 text-center text-gray-500 text-sm">
    
</footer>
@endsection