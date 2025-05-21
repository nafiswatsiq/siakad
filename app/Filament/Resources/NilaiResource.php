<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use App\Models\Nilai;
use Filament\Forms\Form;
use App\Models\Mahasiswa;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\NilaiResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\NilaiResource\RelationManagers;
use App\Models\TahunAjaran;

class NilaiResource extends Resource
{
    protected static ?string $model = Nilai::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('mahasiswa_id')
                    ->label('Nama Mahasiswa')
                    ->options(
                        \App\Models\Mahasiswa::with('user')->get()->mapWithKeys(function ($item) {
                            return [$item->id => $item->user->name];
                        })
                    )
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $set) {
                        $semester = \App\Models\Mahasiswa::where('id', $state)->value('semester_id');
                        $set('semester_id', $semester);
                    })
                    ->required(),
                Forms\Components\TextInput::make('semester_id')
                    ->label('Semester')
                    ->readOnly()
                    ->required(),
                Forms\Components\Select::make('tahun_ajaran_id')
                    ->label('Tahun Ajaran')
                    ->options(TahunAjaran::get()->pluck('nama', 'id'))
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('mahasiswa.user.name')
                    ->label('Nama ')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('ips')
                    ->label('IPS')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('ipk')
                    ->label('IPK')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('semester.nama')
                    ->label('Semester')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tahun_ajaran.nama')
                    ->label('Tahun Ajaran')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->formatStateUsing(fn($state) => $state ? 'Lulus' : 'Tidak Lulus')
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
            'index' => Pages\ManageNilais::route('/'),
        ];
    }
}
