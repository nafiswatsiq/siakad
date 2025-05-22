<?php

namespace App\Filament\Resources\KartuRencanaStudiResource\Widgets;

use App\Models\Nilai;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class HasilStudi extends BaseWidget
{
    protected static ?string $heading = 'Hasil Studi Semester Lalu';

    public function table(Table $table): Table
    {
        return $table
        ->query(Nilai::query())
        ->columns([
            Tables\Columns\TextColumn::make('ipk')->label('IPK'),
            Tables\Columns\TextColumn::make('ips')->label('IPS'),
            Tables\Columns\TextColumn::make('')->label('Status Kelulusan'),
        ]);
    }
}
