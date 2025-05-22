<?php

namespace App\Filament\Resources\KartuHasilStudiResource\Pages;

use App\Filament\Resources\KartuHasilStudiResource;
use App\Filament\Resources\KartuHasilStudiResource\Widgets\HasilAkhirStudi;
use App\Filament\Resources\KartuHasilStudiResource\Widgets\KartuRencanaStudi;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ManageKartuHasilStudis extends ManageRecords
{
    protected static string $resource = KartuHasilStudiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
            Actions\Action::make('cetak_khs')
                ->label('Cetak KHS')
                ->url(fn () => route('khs.cetak', Auth::id()))
                ->openUrlInNewTab()
                ->icon('heroicon-o-printer'),
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
