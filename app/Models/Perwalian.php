<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Perwalian extends Model
{
    protected $fillable = [
        'mahasiswa_id',
        'dosen_id',
        'perihal',
        'status',
        'log',
        'jadwal'
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }

    public function dosen()
    {
        return $this->belongsTo(dosen::class);
    }
}
