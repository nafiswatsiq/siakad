<?php

namespace App\Filament\Resources\KRSResource\Pages;

use App\Filament\Resources\KRSResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageKRS extends ManageRecords
{
    protected static string $resource = KRSResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
