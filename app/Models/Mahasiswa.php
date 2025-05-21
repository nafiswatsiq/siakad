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
        'semester_id',
        'tanggal_lahir',
        'alamat',
        'no_tlp',
    ];
    public function User()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> d6b9a38c4a88c9d46c8470068cd7bd94918d0c8d
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }
    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'prodi_id');
    }
    public function semester()
    {
        return $this->belongsTo(Semester::class, 'semester_id');
<<<<<<< HEAD
=======
    public function Kelas()
    {
        return $this->belongsTo(Kelas::class, 'nama');
>>>>>>> origin/yefta
=======
>>>>>>> d6b9a38c4a88c9d46c8470068cd7bd94918d0c8d
    }
}
