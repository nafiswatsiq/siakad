<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PerwalianResource\Pages;
use App\Filament\Resources\PerwalianResource\RelationManagers;
use App\Models\dosen;
use App\Models\Mahasiswa;
use App\Models\Perwalian;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Get;
use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Model;

class PerwalianResource extends Resource
{
    protected static ?string $model = Perwalian::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('nama_mahasiswa')
                    ->label('Nama Mahasiswa')
                    ->options(Mahasiswa::get()->pluck('user.name', 'id'))
                    ->default(function () {
                        $user = User::find(Auth::id());
                        if($user->hasRole('mahasiswa')) {
                            return $user->mahasiswa->kelas->dosen->first()->id;
                        }
                    })
                    ->disabled()
                    ->required(),
                Forms\Components\Hidden::make('mahasiswa_id')
                    ->default(function () {
                        $user = User::find(Auth::id());
                        if($user->hasRole('mahasiswa')) {
                            return $user->mahasiswa()->first()->id;
                        }
                    }),
                Forms\Components\Select::make('nama_dosen')
                    ->label('Nama Dosen')
                    ->options(Dosen::get()->pluck('user.name', 'id'))
                    ->default(function () {
                        $user = User::find(Auth::id());
                        if($user->hasRole('mahasiswa')) {
                            return $user->mahasiswa->kelas->dosen->first()->id;
                        }
                    })
                    ->disabled()
                    ->required(),
                Forms\Components\Hidden::make('dosen_id')
                    ->default(function () {
                        $user = User::find(Auth::id());
                        if($user->hasRole('mahasiswa')) {
                            return $user->mahasiswa->kelas->dosen->first()->id;
                        }
                    }),
                Forms\Components\Select::make('perihal')
                    ->options([
                        'Administrasi' => 'Administrasi',
                        'Akademik' => 'Akademik',
                        'Bimbingan' => 'Bimbingan',
                    ]),
                Forms\Components\DateTimePicker::make('jadwal')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('jadwal')
                    ->searchable(),
                Tables\Columns\TextColumn::make('mahasiswa.nim')
                    ->label('NIM')
                    ->searchable(), 
                Tables\Columns\TextColumn::make('mahasiswa.user.name')
                    ->label('Nama Mahasiswa')
                    ->searchable(),
                Tables\Columns\TextColumn::make('perihal')
                    ->searchable(),  
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'diterima' => 'success',
                        'ditolak' => 'danger',
                    })
                    ->searchable(),
                Tables\Columns\SelectColumn::make('status')
                    ->options([
                        'diterima' => 'Terima',
                        'ditolak' => 'Tolak'
                        ])
                    ->disabled(fn () => User::find(Auth::id())->hasRole('mahasiswa'))
                    ->rules(['required']),
                Tables\Columns\TextColumn::make('log')
                    ->searchable(),
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
                Action::make('catatan')
                ->form([
                    Forms\Components\Textarea::make('log')
                ])
                ->action(function(Model $record, $data) {
                    Perwalian::find($record->id)->update($data);
                }),
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
            'index' => Pages\ManagePerwalians::route('/'),
        ];
    }
}
