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
        'semester_id'
    ];

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'ruangan_id');
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'dosen_id');
    }
    
    public function semester()
    {
        return $this->belongsTo(Semester::class, 'semester_id');
    }
}