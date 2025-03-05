<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $fillable = [
        'nama',
        'dosen_id',
        'tahun_ajaran',
    ];

    public function dosen()
    {
        return $this->belongsTo(dosen::class);
    }
}
