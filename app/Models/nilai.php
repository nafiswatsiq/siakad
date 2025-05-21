<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    protected $fillable = [
        'mahasiswa_id',
        'ips',
        'ipk',
<<<<<<< HEAD
        'semester',
        'tahun_ajaran',
=======
        'semester_id',
        'tahun_ajaran_id',
        'status'
>>>>>>> ecc62bcb86733a026e1c5b58577e8a4e3c5bd0fa
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id');
    }
<<<<<<< HEAD
=======
    public function semester()
    {
        return $this->belongsTo(Semester::class, 'semester_id');
    }
    public function tahun_ajaran()
    {
        return $this->belongsTo(TahunAjaran::class, 'tahun_ajaran_id');
    }
>>>>>>> ecc62bcb86733a026e1c5b58577e8a4e3c5bd0fa
}
