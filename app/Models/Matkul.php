<?php 
namespace App\Models; 

use Illuminate\Database\Eloquent\Model; 
class Matkul extends Model 
{
    protected $fillable = [
        'kode_matkul',
        'nama',
        'sks',
        'kuota',
        'sesi',
        'ruangan_id',
        'dosen_id',
    ];

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'ruangan_id');
    }

    public function dosen()
    {
        return $this->belongsTo(dosen::class, 'dosen_id');
    }
}