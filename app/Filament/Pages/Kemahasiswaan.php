<?php

namespace App\Filament\Pages;

use App\Models\Kelas;
use App\Models\Mahasiswa;
use App\Models\NilaiMatkul;
use App\Models\User;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Actions;
use Filament\Pages\Page;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


class Kemahasiswaan extends Page implements HasTable
{
    use HasPageShield;
    use InteractsWithTable;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.kemahasiswaan';


    public $mahasiswa;

    public function mount(): void
    {
        $userId = Auth::id();

        // Cari dosen dari user_id
        $dosen = \App\Models\Dosen::where('user_id', $userId)->first();

        if ($dosen) {
            // Cari kelas yang dosen ini sebagai wali_dosen
            $kelasIds = \App\Models\Kelas::where('dosen_id', $dosen->id)->pluck('id');

            if ($kelasIds->isEmpty()) {
                // Dosen bukan wali kelas manapun -> tidak dapat lihat mahasiswa
                $this->mahasiswa = collect();
                return;
            }

            // Ambil mahasiswa dari kelas yang dosen ini sebagai wali
            $this->mahasiswa = \App\Models\Mahasiswa::whereIn('kelas_id', $kelasIds)
                ->with(['user', 'kelas', 'prodi'])
                ->get();
        } else {
            // Kalau bukan dosen (misal admin), tampilkan semua mahasiswa
            $this->mahasiswa = \App\Models\Mahasiswa::with(['user', 'kelas', 'prodi'])->get();
        }
    }


    public function table(Table $table): Table
    {
        return $table
            ->query(function () {
                $userId = Auth::id();

                // Cari dosen dari user_id
                $dosen = \App\Models\Dosen::where('user_id', $userId)->first();

                if ($dosen) {
                    // Cari kelas yang dosen ini sebagai wali_dosen
                    $kelasIds = \App\Models\Kelas::where('dosen_id', $dosen->id)->pluck('id');

                    if ($kelasIds->isEmpty()) {
                        // Return empty query builder if no kelas found
                        return \App\Models\Mahasiswa::whereNull('id'); // Returns empty result
                    }

                    // Return query builder for mahasiswa in the kelas
                    return \App\Models\Mahasiswa::whereIn('kelas_id', $kelasIds)
                        ->with(['user', 'kelas', 'prodi']);
                } else {
                    // For non-dosen (e.g., admin), return all mahasiswa query
                    return \App\Models\Mahasiswa::with(['user', 'kelas', 'prodi']);
                }
            })
            ->columns([
                TextColumn::make('nim')
                    ->label('NIM')
                    ->rowIndex(),
                TextColumn::make('User.name')
                    ->label('Nama')
                    ->searchable(),
                // TextColumn::make('krs')
                //     ->label('KRS')
                //     ->getStateUsing(fn() => null)
                //     ->formatStateUsing(fn() => 'Lihat')
                //     ->html()
                //     ->extraAttributes(['class' => 'text-primary underline cursor-pointer']),
                // TextColumn::make('khs_dummy')
                //     ->label('KHS')
                //     ->getStateUsing(fn() => null)
                //     ->formatStateUsing(fn() => 'Lihat')
                //     ->html()
                //     ->extraAttributes(['class' => 'text-primary underline cursor-pointer']),
            ])

            ->filters([
                // ...
            ])
            ->actions([
                Actions\Action::make('lihat_krs')
                    ->label('Lihat KRS')
                    ->button()
                    ->url(fn (Model $record) => route('filament.admin.resources.kartu-hasil-studis.mahasiswa', $record)),
                Actions\Action::make('lihat_khs')
                    ->label('Lihat KHS')
                    ->button()
                    ->url(fn () => route('filament.admin.resources.kartu-hasil-studis.index')),
            ])
            ->bulkActions([
                // ...
            ]);
    }
}
