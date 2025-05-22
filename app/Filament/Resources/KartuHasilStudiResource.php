<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KartuHasilStudiResource\Pages;
use App\Filament\Resources\KartuHasilStudiResource\RelationManagers;
use App\Models\KartuHasilStudi;
use App\Models\Mahasiswa;
use App\Models\NilaiMatkul;
use App\Models\User;
use App\Models\UserMatkul;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Pages\Concerns\InteractsWithRecord;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class KartuHasilStudiResource extends Resource
{
    
    protected static ?string $model = NilaiMatkul::class;
    protected static ?string $modelLabel = "Kartu Hasil Studi";

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        $user = User::find(Auth::id());
        if($user->hasRole('mahasiswa')) {
            $mahasiswa = Mahasiswa::where('user_id', Auth::id())->first();
            $model = parent::getEloquentQuery()->where('mahasiswa_id', $mahasiswa->id);
        } else {
            $model = parent::getEloquentQuery();
        }
        return $model;
    }

    public static function table(Table $table): Table
    {
         return $table
            ->columns([
                Tables\Columns\TextColumn::make('index')
                ->label('No')
                ->rowIndex(),
                Tables\Columns\TextColumn::make('matkul.kode_matkul')
                ->label('Kode Matkul')
                ->searchable(),
                Tables\Columns\TextColumn::make('matkul.nama')
                ->label('Nama Mata Kuliah')
                ->searchable(),
                Tables\Columns\TextColumn::make('matkul.sks')
                ->label('SKS')
                ->searchable(),
                Tables\Columns\TextColumn::make('nilai')
                ->label('Nilai')
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
            'index' => Pages\ManageKartuHasilStudis::route('/'),
            'mahasiswa' => Pages\KrsMahasiswa::route('/{record}/mahasiswa'),
        ];
    }
}
