<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelajaran extends Model
{
    protected $fillable = ['nama', 'guru_id'];

    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }
}
