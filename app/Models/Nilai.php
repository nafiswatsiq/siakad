<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    protected $fillable = [
        'mahasiswa_id',
        'ips',
        'ipk',
        'semester_id',
        'tahun_ajaran_id',
        'status'
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id');
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class, 'semester_id');
    }

    public function tahun_ajaran()
    {
        return $this->belongsTo(TahunAjaran::class, 'tahun_ajaran_id');
    }
    public function hitungIps()
    {
        // Contoh perhitungan IPS
        // Sesuaikan logika ini dengan sistem SIAKAD kamu

        $matkuls = $this->mahasiswa->khs()
            ->where('semester_id', $this->semester_id)
            ->get();

        $totalNilai = 0;
        $totalSks = 0;

        foreach ($matkuls as $khs) {
            $totalNilai += $khs->nilai_angka * $khs->mataKuliah->sks;
            $totalSks += $khs->mataKuliah->sks;
        }

        if ($totalSks === 0) return 0;

        return round($totalNilai / $totalSks, 2); // IPS dibulatkan 2 angka di belakang koma
    }

<<<<<<< HEAD
}
=======
}
>>>>>>> d93bcab6374afc23c1dca836cc0b323d58aa62b0
