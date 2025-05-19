<?php

namespace App\Filament\Resources\NilaiResource\Pages;

use App\Models\Mahasiswa;
use App\Models\NilaiMatkul;
use Filament\Notifications\Notification;
use App\Filament\Resources\NilaiResource;
use Filament\Resources\Pages\CreateRecord;

class CreateNilai extends CreateRecord
{
    protected static string $resource = NilaiResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $mahasiswa = Mahasiswa::find($data['mahasiswa_id']);

        if (!$mahasiswa) {
            Notification::make()
                ->title('Mahasiswa tidak ditemukan.')
                ->danger()
                ->send();

            return $data;
        }

        //IPS = jumlah(nilai matkul semster* sks matkul semester) / jumlah sks semeter
        //IPS = jumlah(semua nilai matkul * semua sks matkul) / jumlah semua sks
        // Ambil semester & tahun ajaran dari mahasiswa
        $semester = $mahasiswa->semester;
        $tahunAjaran = $mahasiswa->tahun_ajaran;

        // Ambil nilai matkul semester itu
        $nilaiMatkuls = NilaiMatkul::where('mahasiswa_id', $data['mahasiswa_id'])
            ->whereHas('matkul', function ($query) use ($semester) {
                $query->where('semester_id', $semester);
            })
            ->get();

        // Hitung IPS
        $totalSks = $nilaiMatkuls->sum(function ($item) {
            return $item->matkul->sks;
        });

        $totalBobot = $nilaiMatkuls->sum(function ($item) {
            return $item->nilai * $item->matkul->sks;
        });

        $ips = $totalSks > 0 ? $totalBobot / $totalSks : 0;

        // Hitung IPK (semua semester)
        $nilaiMatkulsAll = NilaiMatkul::where('mahasiswa_id', $data['mahasiswa_id'])->get();

        $totalSksAll = $nilaiMatkulsAll->sum(function ($item) {
            return $item->matkul->sks;
        });

        $totalBobotAll = $nilaiMatkulsAll->sum(function ($item) {
            return $item->nilai * $item->matkul->sks;
        });

        $ipk = $totalSksAll > 0 ? $totalBobotAll / $totalSksAll : 0;

        // Masukkan ke data
        $data['semester'] = $semester;
        $data['tahun_ajaran'] = $tahunAjaran;
        $data['ips'] = $ips;
        $data['ipk'] = $ipk;

        return $data;
    }
}
