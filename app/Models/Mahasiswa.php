<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected  $fillable = [
        'user_id',
        'kelas_id',
        'prodi_id',
        'jenis_kelamin',
        'nim',
        'semester',
        'tanggal_lahir',
        'alamat',
        'no_tlp',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
