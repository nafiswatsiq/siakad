<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Perwalian extends Model
{
    protected $fillable = [
        'mahasiswa_id',
        'dosen_id',
        'status',
        'log',
        'jadwal'
    ];
}
