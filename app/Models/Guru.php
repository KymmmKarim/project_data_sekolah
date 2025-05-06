<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    protected $fillable = ['name', 'email'];

    public function pelajarans()
    {
        return $this->hasMany(Pelajaran::class);
    }
}
