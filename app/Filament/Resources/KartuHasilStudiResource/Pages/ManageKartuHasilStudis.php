<?php

namespace App\Filament\Resources\KartuHasilStudiResource\Pages;

use App\Filament\Resources\KartuHasilStudiResource;
use App\Filament\Resources\KartuHasilStudiResource\Widgets\HasilAkhirStudi;
use App\Filament\Resources\KartuHasilStudiResource\Widgets\KartuRencanaStudi;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageKartuHasilStudis extends ManageRecords
{
    protected static string $resource = KartuHasilStudiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            
        ];
        //  return [];
        
    }
        protected function getFooterWidgets(): array
    {
        return [
            HasilAkhirStudi::class,
        ];
    }
}
