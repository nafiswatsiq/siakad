<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use App\Models\Dosen;
use App\Models\Matkul;
use App\Models\Semester;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\MatkulResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\MatkulResource\RelationManagers;

class MatkulResource extends Resource
{
    protected static ?string $model = Matkul::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

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
                Forms\Components\Select::make('sesi')
                    ->required()
                        ->options([
                        '08.00 - 09.00' => '08.00 - 09.00',
                        '09.00 - 10.00' => '09.00 - 10.00',
                        '10.00 - 11.00' => '10.00 - 11.00',
                        '11.00 - 12.00' => '11.00 - 12.00',
                        '13.00 - 14.00' => '13.00 - 14.00',
                        '14.00 - 15.00' => '14.00 - 15.00',
                        '15.00 - 16.00' => '15.00 - 16.00',
                    ])
                    ->native(false),
                Forms\Components\Select::make('ruangan_id')
                    ->label('Ruangan')
                    ->relationship('ruangan', 'kode_ruangan')
                    ->getOptionLabelFromRecordUsing(fn ($record) => "{$record->kode_ruangan} - {$record->nama}")
                    ->required(),
    
                Forms\Components\Select::make('dosen_id')
                    ->label('Dosen')
                    ->options(Dosen::get()->pluck('user.name', 'id'))
                    ->required(),
                Forms\Components\Select::make('semester_id')
                    ->label('Semester')
                    ->options(Semester::get()->pluck('nama', 'id'))
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function (Builder $query) {
                $user = Auth::user();

                if ($user->dosen) {
                    $query->where('dosen_id', $user->dosen->id);
                }
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
                Tables\Columns\TextColumn::make('ruangan.nama')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('dosen.user.name')
                    ->label('Dosen')
                    ->numeric()
                    ->sortable(),
                     Tables\Columns\TextColumn::make('semester.nama')
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
