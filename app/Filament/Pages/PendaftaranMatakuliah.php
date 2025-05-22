<?php

namespace App\Filament\Pages;

use BezhanSalleh\FilamentShield\Traits\HasPageShield as TraitsHasPageShield;
use Filament\Pages\Page;

class PendaftaranMatakuliah extends Page
{
    use TraitsHasPageShield;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.pendaftaran-matakuliah';
}
