<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserMatkulResource\Pages;
use App\Filament\Resources\UserMatkulResource\RelationManagers;
use App\Models\UserMatkul;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class UserMatkulResource extends Resource
{
    protected static ?string $model = UserMatkul::class;
    protected static ?string $slug = 'jadwal-perkuliahan';
    public static function getPluralLabel(): string
    {
        return 'Jadwal Perkuliahan';
    }

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Jadwal Perkuliahan';

    public static function table(Table $table): Table
    {
        return $table
            ->query(
                UserMatkul::query()
                    ->with(['matkul', 'matkul.ruangan', 'matkul.dosen.user'])
                    ->where('user_id', Auth::id())
            )
            ->columns([
                Tables\Columns\TextColumn::make('matkul.kode_matkul')
                    ->label('Kode Matkul')
                    ->searchable(),
                Tables\Columns\TextColumn::make('matkul.nama')
                    ->label('Nama Matkul')
                    ->searchable(),
                Tables\Columns\TextColumn::make('matkul.sks')
                    ->label('SKS')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('matkul.hari')
                    ->label('Hari')
                    ->searchable(),
                Tables\Columns\TextColumn::make('matkul.sesi')
                    ->label('Sesi')
                    ->searchable(),
                Tables\Columns\TextColumn::make('matkul.ruangan.nama')
                    ->label('Ruangan')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('matkul.dosen.user.name')
                    ->label('Dosen')
                    ->numeric()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\ViewAction::make(),
                // Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUserMatkuls::route('/'),
            // 'create' => Pages\CreateUserMatkul::route('/create'),
            // 'view' => Pages\ViewUserMatkul::route('/{record}'),
            // 'edit' => Pages\EditUserMatkul::route('/{record}/edit'),
        ];
    }
}
