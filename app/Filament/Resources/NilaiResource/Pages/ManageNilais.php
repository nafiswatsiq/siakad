<?php

namespace App\Filament\Resources\NilaiResource\Pages;

use Filament\Actions;
use App\Models\Mahasiswa;
use App\Models\NilaiMatkul;
use Filament\Notifications\Notification;
use App\Filament\Resources\NilaiResource;
use Filament\Resources\Pages\ManageRecords;

class ManageNilais extends ManageRecords
{
    protected static string $resource = NilaiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->mutateFormDataUsing(function ($data) {
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
                    $semester = $mahasiswa->semester_id;
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

                    #cek status
                    if ($ipk > 2.00) {
                        $status = true;
                        $mahasiswa->semester_id = $mahasiswa->semester_id + 1;
                        $mahasiswa->save();
                    } else {
                        $status = false;
                    }

                    $data['semester'] = $semester;
                    $data['tahun_ajaran'] = $tahunAjaran;
                    $data['ips'] = $ips;
                    $data['ipk'] = $ipk;
                    $data['status'] = $status;
                    return $data;
                }),
        ];
    }
}
