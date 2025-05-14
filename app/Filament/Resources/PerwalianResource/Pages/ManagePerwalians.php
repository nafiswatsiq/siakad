<?php

namespace App\Filament\Resources\PerwalianResource\Pages;

use App\Filament\Resources\PerwalianResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManagePerwalians extends ManageRecords
{
    protected static string $resource = PerwalianResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
