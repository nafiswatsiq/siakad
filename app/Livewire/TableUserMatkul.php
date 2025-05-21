<?php

namespace App\Livewire;

use App\Models\UserMatkul;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class TableUserMatkul extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public function table(Table $table): Table
    {
        return $table
            ->query(UserMatkul::query()
                ->with(['matkul', 'matkul.ruangan', 'matkul.dosen.user'])
                ->where('user_id', Auth::id())
            )
            ->columns([
                Tables\Columns\TextColumn::make('matkul.kode_matkul')
                    ->label('Kode Matkul')
                    ->searchable(),
                Tables\Columns\TextColumn::make('matkul.nama')
                    ->label('Nama Matkul')
                    ->searchable(),
                Tables\Columns\TextColumn::make('matkul.sks')
                    ->label('SKS')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('matkul.sesi')
                    ->label('Sesi')
                    ->searchable(),
                Tables\Columns\TextColumn::make('matkul.ruangan.nama')
                    ->label('Ruangan')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('matkul.dosen.user.name')
                    ->label('Dosen')
                    ->numeric()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                //
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    //
                ]),
            ])
            ->poll('1s');
    }

    public function render(): View
    {
        return view('livewire.table-user-matkul');
    }
}
