<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KartuRencanaStudi extends Model
{   
    protected $table = 'user_matkuls';
    protected $fillable = [
        'kode_matkul', 
        'nama', 
        'sks'
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }

    public function mataKuliah()
    {
        return $this->belongsTo(Matkul::class, 'kode_matkul', 'kode');
    }
}
