<?php

namespace App\Filament\Resources\KartuHasilStudiResource\Widgets;

use App\Models\Nilai;
use App\Models\UserMatkul;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Support\Facades\Auth;

class HasilAkhirStudi extends BaseWidget
{
    protected static ?string $heading = 'Hasil Akhir Studi';

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
