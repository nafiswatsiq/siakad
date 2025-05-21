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
            // Nama Mahasiswa - tampilkan nama sesuai user login, disable input
            Forms\Components\TextInput::make('nama_mahasiswa')
                ->label('Nama Mahasiswa')
                ->default(function () {
                    $user = Auth::user();
                    return $user?->mahasiswa?->user?->name ?? '-';
                })
                ->disabled(),

            // Simpan mahasiswa_id tersembunyi
            Forms\Components\Hidden::make('mahasiswa_id')
                ->default(function () {
                    $user = Auth::user();
                    return $user?->mahasiswa?->id;
                }),

            // Nama Dosen Wali - tampilkan nama sesuai kelas mahasiswa login, disable input
            Forms\Components\TextInput::make('nama_dosen')
                ->label('Nama Dosen Wali')
                ->default(function () {
                    $user = Auth::user();
                    return $user?->mahasiswa?->kelas?->dosen?->first()?->user?->name ?? '-';
                })
                ->disabled(),

            // Simpan dosen_id tersembunyi
            Forms\Components\Hidden::make('dosen_id')
                ->default(function () {
                    $user = Auth::user();
                    return $user?->mahasiswa?->kelas?->dosen?->first()?->id;
                }),

            Forms\Components\Select::make('perihal')
                ->label('Perihal')
                ->options([
                    'Administrasi' => 'Administrasi',
                    'Akademik' => 'Akademik',
                    'Bimbingan' => 'Bimbingan',
                ])
                ->required(),

            Forms\Components\DateTimePicker::make('jadwal')
                ->label('Jadwal Konsultasi')
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
                    ->color(fn(string $state): string => match ($state) {
                        'diterima' => 'success',
                        'ditolak' => 'danger',
                    })
                    ->searchable()
                    ->visible(fn () => User::find(Auth::id())->hasRole('mahasiswa')),
                Tables\Columns\SelectColumn::make('status')
                    ->options([
                        'diterima' => 'Terima',
                        'ditolak' => 'Ubah Jadwal'
                    ])
                    ->disabled(fn() => User::find(Auth::id())->hasRole('mahasiswa'))
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
                    ->label('Catatan')
                    ->form([
                        Forms\Components\Textarea::make('log')
                            ->label('Catatan'),
                    ])
                    ->action(function (Model $record, array $data) {
                        $record->update([
                            'log' => $data['log'],
                        ]);
                    })
                    ->visible(function (Model $record) {
                        return $record->status === 'diterima' && User::find(Auth::id())->hasRole('dosen_wali');
                    }),

                Action::make('ubah_jadwal')
                    ->label('Ubah Jadwal')
                    ->form([
                        Forms\Components\DateTimePicker::make('jadwal')
                            ->label('Jadwal Baru')
                            ->required(),
                    ])
                    ->action(function (Model $record, array $data) {
                        $record->update([
                            'jadwal' => $data['jadwal'],
                            'status' => 'diterima',
                        ]);
                    })
                    ->visible(function (Model $record) {
                        return $record->status === 'ditolak' && User::find(Auth::id())->hasRole('dosen_wali');
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
