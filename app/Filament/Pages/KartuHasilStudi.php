<?php

namespace App\Filament\Pages;

use App\Models\Kelas;
use App\Models\KHS;
use App\Models\Mahasiswa;
use App\Models\Matkul;
use App\Models\NilaiMatkul;
use App\Models\User;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;

class KartuHasilStudi extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.kartu-hasil-studi';

    public $matkuls;
    // public $mahasiswa;

    public function mount()
    {
        $mahasiswa = Mahasiswa::where('user_id', Auth::id())->first();

         if (!$mahasiswa) {
            $this->matkuls = collect(); // kosongkan koleksi jika tidak ditemukan
            return;
        }

        $this->matkuls = NilaiMatkul::with('matkul')
            ->where('mahasiswa_id', $mahasiswa->id)
            ->get();

        // $mahasiswa = Mahasiswa::where('user_id', Auth::id())->first();
        // $this->matkuls = NilaiMatkul::with('matkul')
        //     ->where('mahasiswa_id', $mahasiswa?->id)
        //     ->get();

        // $this->matkuls = Kj::with('matkul')
        // ->where('mahasiswa_id', Auth::id())
        // ->get();

                // $this->matkuls = NilaiMatkul::with('matkul')
                // ->where('mahasiswa_id', Auth::id())
                // ->get();
                // dd($this->matkuls); 

        // $dosenId = Auth::id();

        // // Ambil kelas yang diampu oleh dosen ini
        // $kelasIds = Kelas::where('dosen_id', $dosenId)->pluck('id');

        // // Ambil mahasiswa dari kelas-kelas tersebut
        // $this->mahasiswa = Mahasiswa::whereIn('kelas_id', $kelasIds)
        //     ->with(['user', 'kelas', 'prodi'])
        //     ->get();
        // dd($this->mahasiswa);
    }

}