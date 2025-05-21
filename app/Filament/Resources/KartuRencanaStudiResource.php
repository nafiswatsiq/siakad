<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KartuRencanaStudiResource\Pages;
use App\Filament\Resources\KartuRencanaStudiResource\RelationManagers;
use App\Models\KartuHasilStudi;
use App\Models\KartuRencanaStudi;
use App\Models\Matkul;
use App\Models\UserMatkul;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class KartuRencanaStudiResource extends Resource
{
    protected static ?string $model = UserMatkul::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $modelLabel = 'Kartu Rencana Studi';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('user_id', Auth::id());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('index')
                ->label('No')
                ->rowIndex(),
                Tables\Columns\TextColumn::make('matkul.kode_matkul')
                ->label('Kode Mata Kuliah')
                ->searchable(),
                Tables\Columns\TextColumn::make('matkul.nama')
                ->label('Mata Kuliah')
                ->searchable(),
                Tables\Columns\TextColumn::make('matkul.sks')
                ->label('SKS')
                ->numeric()
                ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
                // Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make
                ([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            // untuk memanggil footer
            // ->contentFooter(view('filament.krs.footer'))
            // ->emptyStateHeading('Tidak ada mata kuliah terdaftar') 
            // ->paginated([10, 25, 50, 'all'])
            ;
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageKartuRencanaStudis::route('/'),
        ];
    }
}
