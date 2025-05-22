<?php

namespace App\Filament\Resources\KartuHasilStudiResource\Pages;

use App\Filament\Resources\KartuHasilStudiResource;
use App\Models\Mahasiswa;
use App\Models\NilaiMatkul;
use Filament\Resources\Pages\Page;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Actions;

class KhsMahasiswa extends Page implements HasTable
{
    use InteractsWithTable;
    public $record;
    public $mahasiswa;

    public function getHeading(): string
    {
        return __('KHS '. $this->mahasiswa->user->name);
    }

    protected static string $resource = KartuHasilStudiResource::class;

    public function mount(int | string $record): void
    {
        $this->record = $record;
        $this->mahasiswa = Mahasiswa::find($record);
    }

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
            Actions\Action::make('cetak_khs')
                ->label('Cetak KHS')
                ->url(fn () => route('khs.cetak', $this->mahasiswa->user->id))
                ->openUrlInNewTab()
                ->icon('heroicon-o-printer'),
        ];
        //  return [];
        
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(
                NilaiMatkul::query()->where('mahasiswa_id', $this->record)
            )
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
                // ...
            ])
            ->actions([
                // ...
            ])
            ->bulkActions([
                // ...
            ]);
    }

    protected static string $view = 'filament.resources.kartu-hasil-studi-resource.pages.khs-mahasiswa';
}
