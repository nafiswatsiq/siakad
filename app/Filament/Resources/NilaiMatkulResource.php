<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use App\Models\dosen;
use App\Models\Matkul;
use Filament\Forms\Form;
use App\Models\Mahasiswa;
use Filament\Tables\Table;
use App\Models\NilaiMatkul;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\NilaiMatkulResource\Pages;
use App\Filament\Resources\NilaiMatkulResource\RelationManagers;

class NilaiMatkulResource extends Resource
{
    protected static ?string $model = NilaiMatkul::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('mahasiswa_id')
                    ->label('Nama Mahasiswa')
                    ->options(Mahasiswa::get()->pluck('user.name', 'id'))
                    ->required(),
                Forms\Components\Select::make('matkul_id')
                    ->label('Mata Kuliah')
                    ->placeholder('Pilih Mata Kuliah')
                    ->options(function () {
                        $dosenId = Dosen::where('user_id', Auth::id())->value('id');
                        return Matkul::where('dosen_id', $dosenId)->pluck('nama', 'id');
                    })
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $set) {
                        $matkul = Matkul::with('semester')->find($state);
                        $set('semester_id', $matkul->semester_id);
                    })
                    ->required(),
                Forms\Components\TextInput::make('nilai')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('semester_id')
                    ->label('Semester')
                    ->readOnly()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('mahasiswa.user.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('matkul.nama')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('nilai')
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
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ManageNilaiMatkuls::route('/'),
        ];
    }
}
