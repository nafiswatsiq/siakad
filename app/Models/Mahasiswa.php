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
<<<<<<< HEAD
    public function User()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function Kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }
     
    public function Prodi()
    {
        return $this->belongsTo(Prodi::class, 'prodi_id');
    }
=======
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
>>>>>>> 4a430c8900a7a36c32af7c2cc1dbfa52b0e610f8
}
