<?php

namespace App\Livewire;

use App\Models\Mahasiswa;
use App\Models\Matkul;
use App\Models\UserMatkul;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Tables;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class TableMatkul extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public function table(Table $table): Table
    {
        $userId = Auth::id();
        $mahasiswa = Mahasiswa::where('user_id', $userId)->first();

        return $table
            ->query(
                Matkul::query()
                    ->where('semester_id', $mahasiswa->semester_id)
                    // ->where('prodi_id', $mahasiswa->prodi_id)
                    ->with(['ruangan', 'dosen'])
            )
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
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\Action::make('ambil')
                    ->label('Ambil')
                    ->icon('heroicon-o-plus')
                    ->button()
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalHeading('Ambil Matkul')
                    ->action(function (Matkul $record) {
                        // Logic to handle the action
                        // dd($record);
                        if ($record->kuota <= 0) {
                            Notification::make()
                                ->title('Gagal')
                                ->body('Kuota matkul ' . $record->nama . ' sudah penuh')
                                ->icon('heroicon-o-x-circle')
                                ->danger()
                                ->send();
                            return;
                        }
                        if (UserMatkul::where('user_id', Auth::id())->where('matkul_id', $record->id)->exists()) {
                            Notification::make()
                                ->title('Gagal')
                                ->body('Anda sudah mengambil matkul ' . $record->nama)
                                ->icon('heroicon-o-x-circle')
                                ->danger()
                                ->send();
                            return;
                        }
                        UserMatkul::create([
                            'user_id' => Auth::id(),
                            'matkul_id' => $record->id,
                        ]);
                        Matkul::where('id', $record->id)->update([
                            'kuota' => $record->kuota - 1,
                        ]);
                        Notification::make()
                            ->title('Berhasil')
                            ->body('Berhasil mengambil matkul ' . $record->nama)
                            ->icon('heroicon-o-check-circle')
                            ->success()
                            ->send();
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    //
                ]),
            ]);
    }

    public function render(): View
    {
        return view('livewire.table-matkul');
    }
}
