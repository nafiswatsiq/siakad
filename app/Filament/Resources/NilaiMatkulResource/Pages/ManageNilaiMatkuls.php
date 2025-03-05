<?php

namespace App\Filament\Resources\NilaiMatkulResource\Pages;

use App\Filament\Resources\NilaiMatkulResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageNilaiMatkuls extends ManageRecords
{
    protected static string $resource = NilaiMatkulResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
