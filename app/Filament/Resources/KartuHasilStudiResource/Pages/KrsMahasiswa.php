<?php

namespace App\Filament\Resources\KartuHasilStudiResource\Pages;

use App\Filament\Resources\KartuHasilStudiResource;
use Filament\Resources\Pages\Concerns\InteractsWithRecord;
use Filament\Resources\Pages\Page;

class KrsMahasiswa extends Page
{
    use InteractsWithRecord;
    
    protected static string $resource = KartuHasilStudiResource::class;
    protected static string $view = 'filament.resources.kartu-hasil-studi-resource.pages.krs-mahasiswa';

    public function mount(int | string $record): void
    {
        $this->record = $this->resolveRecord($record);
        // dd($this->record);
    }
    

}
