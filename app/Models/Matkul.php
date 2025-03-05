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
        'id_ruangan',
        'id_dosen',
    ];

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'id_ruangan');
    }

    public function dosen()
    {
        return $this->belongsTo(dosen::class, 'id_dosen');
    }
}