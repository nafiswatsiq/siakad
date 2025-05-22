<?php

namespace App\Filament\Resources\KartuRencanaStudiResource\Widgets;

use App\Models\Nilai;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Support\Facades\Auth;

class HasilStudi extends BaseWidget
{
    protected static ?string $heading = 'Hasil Studi Semester Lalu';

    public function table(Table $table): Table
    {
         return $table
        ->query(function () {
            return Nilai::whereHas('mahasiswa', function ($query) {
                $query->where('user_id', Auth::id());
            });
        })       
        ->columns([
            Tables\Columns\TextColumn::make('ipk')->label('IPK'),
            Tables\Columns\TextColumn::make('ips')->label('IPS'),
            Tables\Columns\TextColumn::make('status')
                ->label('Status Kelulusan')
                ->formatStateUsing(function ($state) {
                    return $state ? 'Lulus' : 'Tidak Lulus';
                }),
        ]);
    }
}
