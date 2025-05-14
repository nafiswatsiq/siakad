<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MatkulResource\Pages;
use App\Filament\Resources\MatkulResource\RelationManagers;
use App\Models\dosen;
use App\Models\Matkul;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class MatkulResource extends Resource
{
    protected static ?string $model = Matkul::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $slug = 'mata-kuliah';
    public static function getPluralLabel(): string
    {
        return 'Mata Kuliah';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('kode_matkul')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('nama')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('sks')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('kuota')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('sesi')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('hari')
                    ->label('Hari')
                    ->options([
                        'Senin'  => 'Senin',
                        'Selasa' => 'Selasa',
                        'Rabu'   => 'Rabu',
                        'Kamis'  => 'Kamis',
                        'Jumat'  => 'Jumat',
                    ])
                    ->required(),
                Forms\Components\Select::make('ruangan_id')
                    ->label('Ruangan')
                    ->relationship('ruangan', 'kode_ruangan')
                    ->getOptionLabelFromRecordUsing(fn($record) => "{$record->kode_ruangan} - {$record->nama}")
                    ->required(),
                Forms\Components\Select::make('dosen_id')
                    ->label('Dosen')
                    ->options(dosen::get()->pluck('user.name', 'id'))
                    ->required(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->query(function () {
                $query = Matkul::query()->with(['dosen']);

                if (User::find(Auth::id())->hasRole('dosen')) {
                    $query->whereHas('dosen', function ($q) {
                        $q->where('user_id', Auth::id());
                    });
                }

                return $query;
            })
            ->columns([
                Tables\Columns\TextColumn::make('kode_matkul')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nama')
                    ->searchable(),
                Tables\Columns\TextColumn::make('sks')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('kuota')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('sesi')
                    ->searchable(),
                Tables\Columns\TextColumn::make('hari')
                    ->searchable(),
                Tables\Columns\TextColumn::make('ruangan.nama')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('dosen.user.name')
                    ->label('Dosen')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ManageMatkuls::route('/'),
        ];
    }
}
