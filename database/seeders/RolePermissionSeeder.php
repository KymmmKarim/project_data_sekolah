<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        $permissions = ['lihat siswa', 'tambah siswa', 'edit siswa', 'hapus siswa',
                        'lihat kelas', 'tambah kelas', 'edit kelas', 'hapus kelas',
                        'lihat pelajaran', 'tambah pelajaran', 'edit pelajaran', 'hapus pelajaran',
                        'lihat jadwal', 'tambah jadwal', 'edit jadwal', 'hapus jadwal'];
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $admin  = Role::firstOrCreate(['name' => 'admin']);
        $editor = Role::firstOrCreate(['name' => 'editor']);
        $guru   = Role::firstOrCreate(['name' => 'guru']);
        $siswa  = Role::firstOrCreate(['name' => 'siswa']);

        $admin->givePermissionTo(Permission::all());
        $editor->givePermissionTo([
            'lihat siswa', 'tambah siswa', 'edit siswa',
            'lihat kelas', 'tambah kelas', 'edit kelas',
            'lihat pelajaran', 'tambah pelajaran', 'edit pelajaran',
            'lihat jadwal', 'tambah jadwal', 'edit jadwal',
        ]);
        $guru->givePermissionTo(['lihat siswa', 'lihat kelas', 'lihat pelajaran', 'lihat jadwal']);
        $siswa->givePermissionTo(['lihat siswa', 'lihat kelas', 'lihat pelajaran', 'lihat jadwal']);

        $adminUser = User::create([
            'name' => 'Admin Sekolah',
            'email' => 'admin@sekolah.com',
            'password' => bcrypt('password'),
        ]);
        $adminUser->assignRole('admin');

        $editorUser = User::create([
            'name' => 'Editor Sekolah',
            'email' => 'editor@sekolah.com',
            'password' => bcrypt('password'),
        ]);
        $editorUser->assignRole('editor');

        $guruUser = User::create([
            'name' => 'Guru Sekolah',
            'email' => 'guru@sekolah.com',
            'password' => bcrypt('password'),
        ]);
        $guruUser->assignRole('guru');

        $siswaUser = User::create([
            'name' => 'Siswa Sekolah',
            'email' => 'siswa@sekolah.com',
            'password' => bcrypt('password'),
        ]);
        $siswaUser->assignRole('siswa');
    }
}