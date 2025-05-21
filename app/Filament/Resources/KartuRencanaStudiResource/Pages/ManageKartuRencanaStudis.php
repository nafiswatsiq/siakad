<?php

namespace App\Filament\Resources\KartuRencanaStudiResource\Pages;

use App\Filament\Resources\KartuRencanaStudiResource;
use App\Filament\Resources\KartuRencanaStudiResource\Widgets\HasilStudi;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageKartuRencanaStudis extends ManageRecords
{
    protected static string $resource = KartuRencanaStudiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
    protected function getFooterWidgets(): array
    {
        return [
            HasilStudi::class,
        ];
    }
}
