<?php

namespace App\Filament\Resources\MatkulResource\Pages;

use App\Filament\Resources\MatkulResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageMatkuls extends ManageRecords
{
    protected static string $resource = MatkulResource::class;

    protected ?string $heading = 'Mata Kuliah';
    protected static ?string $title = 'Mata Kuliah';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
