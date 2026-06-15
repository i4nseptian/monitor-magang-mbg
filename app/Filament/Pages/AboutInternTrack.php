<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class AboutInternTrack extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-information-circle';

    protected static string $view = 'filament.pages.about-interntrack';

    protected static ?string $navigationLabel = 'Tentang InternTrack';

    protected static ?string $title = 'Tentang InternTrack';

    protected static ?string $navigationGroup = 'Sistem & Keamanan';

    protected static ?int $navigationSort = 99;
}
