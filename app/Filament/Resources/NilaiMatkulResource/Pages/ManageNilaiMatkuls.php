<?php

namespace App\Filament\Resources\NilaiMatkulResource\Pages;

use Filament\Actions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Filament\Resources\Pages\ManageRecords;
use App\Filament\Resources\NilaiMatkulResource;
use App\Models\Matkul;

class ManageNilaiMatkuls extends ManageRecords
{
    protected static string $resource = NilaiMatkulResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->mutateFormDataUsing(function ($data) {
                $nilai = $data['nilai'];
                if ($nilai >= 80 && $nilai <= 100) {
                    $data['nilai'] = 4;
                } elseif ($nilai >= 75 && $nilai < 80) {
                    $data['nilai'] = 3.5;
                } elseif ($nilai >= 65 && $nilai < 75) {
                    $data['nilai'] = 3;
                } elseif ($nilai >= 60 && $nilai < 65) {
                    $data['nilai'] = 2.5;
                } elseif ($nilai >= 50 && $nilai < 60) {
                    $data['nilai'] = 2;
                } elseif ($nilai >= 40 && $nilai < 50) {
                    $data['nilai'] = 1;
                } elseif ($nilai < 40) {
                    $data['nilai'] = 0;
                }
                return $data;
            }),
        ];
    }
}
