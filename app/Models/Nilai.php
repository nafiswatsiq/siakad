<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Nilai extends Model
{
    protected $fillable = [
        'mahasiswa_id',
        'ips',
        'ipk',
        'semester',
        'tahun_ajaran',
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id');
    }

    public function nilaiMatkuls()
{
    return $this->hasMany(NilaiMatkul::class, 'mahasiswa_id', 'mahasiswa_id');
}

public function hitungIps()
{
    $totalNilai = $this->nilaiMatkuls()
        ->join('matkuls', 'nilai_matkuls.matkul_id', '=', 'matkuls.id')
        ->sum(DB::raw('nilai_matkuls.nilai * matkuls.sks'));

    $totalSks = $this->nilaiMatkuls()
        ->join('matkuls', 'nilai_matkuls.matkul_id', '=', 'matkuls.id')
        ->sum('matkuls.sks');

    return $totalSks > 0 ? round($totalNilai / $totalSks, 2) : 0;
}


public function hitungIpk()
{
    $nilaiPerSemester = self::where('mahasiswa_id', $this->mahasiswa_id)
        ->where('semester', '<=', $this->semester)
        ->get();

    $totalIps = 0;
    $totalSemester = $nilaiPerSemester->count();

    foreach ($nilaiPerSemester as $nilai) {
        $totalIps += $nilai->hitungIps();
    }

    return $totalSemester > 0 ? round($totalIps / $totalSemester, 2) : 0;
}


}
