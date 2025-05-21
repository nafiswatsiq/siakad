<?php

namespace App\Filament\Pages;

use App\Models\Kelas;
use App\Models\Mahasiswa;
use App\Models\NilaiMatkul;
use App\Models\User;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;


class Kemahasiswaan extends Page
{
    use HasPageShield;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.kemahasiswaan';

    public $mahasiswa;

    public function mount(): void
    {
        $userId = Auth::id();

        // Cari dosen dari user_id
        $dosen = \App\Models\Dosen::where('user_id', $userId)->first();

        if ($dosen) {
            // Cari kelas yang dosen ini sebagai wali_dosen
            $kelasIds = \App\Models\Kelas::where('dosen_id', $dosen->id)->pluck('id');

            if ($kelasIds->isEmpty()) {
                // Dosen bukan wali kelas manapun -> tidak dapat lihat mahasiswa
                $this->mahasiswa = collect();
                return;
            }

            // Ambil mahasiswa dari kelas yang dosen ini sebagai wali
            $this->mahasiswa = \App\Models\Mahasiswa::whereIn('kelas_id', $kelasIds)
                ->with(['user', 'kelas', 'prodi'])
                ->get();
        } else {
            // Kalau bukan dosen (misal admin), tampilkan semua mahasiswa
            $this->mahasiswa = \App\Models\Mahasiswa::with(['user', 'kelas', 'prodi'])->get();
        }
    }
}
