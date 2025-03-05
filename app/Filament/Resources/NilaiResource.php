<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NilaiResource\Pages;
use App\Filament\Resources\NilaiResource\RelationManagers;
use App\Models\Nilai;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class NilaiResource extends Resource
{
    protected static ?string $model = Nilai::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('id_mahasiswa')
                    ->relationship('user', 'name')
                    ->required(),
                Forms\Components\TextInput::make('ips')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('ipk')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('semester')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('tahun_ajaran')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('ips')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('ipk')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('semester')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tahun_ajaran')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageNilais::route('/'),
        ];
    }
}
