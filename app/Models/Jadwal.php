<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    protected $fillable = [
        'hari',
        'jam_mulai',
        'jam_selesai',
        'kelas_id',
        'pelajaran_id',
        'guru_id', // jika menggunakan guru
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function pelajaran()
    {
        return $this->belongsTo(Pelajaran::class);
    }

    public function guru()
    {
        return $this->belongsTo(User::class, 'guru_id');
    }
}