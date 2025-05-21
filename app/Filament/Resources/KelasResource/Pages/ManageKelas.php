<?php

namespace App\Filament\Resources\KelasResource\Pages;

use App\Models\User;
use App\Models\dosen;
use Filament\Actions;
use App\Filament\Resources\KelasResource;
use Filament\Resources\Pages\ManageRecords;

class ManageKelas extends ManageRecords
{
    protected static string $resource = KelasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
            ->mutateFormDataUsing(function ($data) {
                $dosen = Dosen::with('user')->find($data['dosen_id']);
                if ($dosen && $dosen->user) {
                    $dosen->user->assignRole('dosen_wali');
                }
                return $data;
            }),
        ];
    }
}
