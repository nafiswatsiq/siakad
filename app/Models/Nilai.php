<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    protected $fillable = [
        'id_mahasiswa',
        'ips',
        'ipk',
        'semester',
        'tahun_ajaran',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
