<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class nilai extends Model
{
    protected $fillable = [
        'id_mahasiswa',
        'ips',
        'ipk',
        'semester',
        'tahun_ajaran'
    ];
}
