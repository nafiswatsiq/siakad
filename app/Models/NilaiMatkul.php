<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NilaiMatkul extends Model
{
    protected $fillable = [
        'mahasiswa_id',
        'matkul_id',
        'nilai',
        'semester_id'
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id');
    }

    public function matkul()
    {
        return $this->belongsTo(Matkul::class, 'matkul_id');
    }
    public function semester()
    {
        return $this->belongsTo(Semester::class, 'semester_id');
    }
}