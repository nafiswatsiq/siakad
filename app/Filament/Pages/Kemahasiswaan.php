<?php

namespace App\Filament\Pages;

use App\Models\NilaiMatkul;
use Filament\Pages\Page;
use Illuminate\Container\Attributes\Auth;

class Kemahasiswaan extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.kemahasiswaan';

    public $matkuls;

    //public function mount()
    //{
    // $this->matkuls = KHS::with('matkul')
    // ->where('mahasiswa_id', Auth::id())
    // ->get();
    //  $this->matkuls = NilaiMatkul::with(['matkul', 'mahasiswa'])
    //    ->whereHas('mahasiswa', function ($query) {
    //      $query->where('dosen_wali_id', Auth::id());
    //})
    //->get();

    // dd($this->matkuls);
    //}
}
