<?php

namespace App\Filament\Pages;

use App\Models\Mahasiswa;
use App\Models\Perwalian;
use App\Models\User;
use Filament\Pages\Page;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class Persetujuan extends Page implements HasTable
{
    use InteractsWithTable;

    public $user;

    public function mount()
    {
        $this->user = User::all();
    }

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    public function table(Table $table): Table
    {
        return $table
            ->query(Perwalian::query()) // Menentukan query untuk tabel
            ->columns([ // Mendefinisikan kolom tabel
                TextColumn::make('jadwal') //nanti di ubah jika tabel pengajuan sudah ada
                    ->label('Waktu'),
                TextColumn::make('nim')
                    ->label('NIM'),
                TextColumn::make('user.name')
                    ->label('Nama'),
                TextColumn::make('perihal') //nanti di ubah jika tabel pengajuan sudah ada
                    ->label('Perihal')

            ])
            ->filters([ // Mendefinisikan filter tabel (jika ada)
                // ...
            ])
            ->actions([ // Mendefinisikan aksi (misal: edit, delete)
                // ...
            ])
            ->bulkActions([ // Mendefinisikan aksi bulk (misal: hapus massal)
                // ...
            ]);
    }

    protected static string $view = 'filament.pages.persetujuan'; // Menentukan view halaman
}
