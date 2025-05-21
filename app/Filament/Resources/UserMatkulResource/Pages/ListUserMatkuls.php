<?php

namespace App\Filament\Resources\UserMatkulResource\Pages;

use App\Filament\Resources\UserMatkulResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUserMatkuls extends ListRecords
{
    protected static string $resource = UserMatkulResource::class;

    protected ?string $heading = 'Jadwal Perkuliahan';
    protected static ?string $title = 'Jadwal Perkuliahan';

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
