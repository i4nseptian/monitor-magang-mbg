<?php

namespace App\Filament\Resources\DocumentationResource\Pages;

use App\Filament\Resources\DocumentationResource;
use Filament\Actions;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Support\Facades\Storage;

class ViewDocumentation extends ViewRecord
{
    protected static string $resource = DocumentationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make()
                ->label('Edit Dokumentasi'),
            Actions\Action::make('download_all')
                ->label('Unduh Semua')
                ->icon('heroicon-o-arrow-down-tray')
                ->color('success')
                ->url(fn () => $this->record->photos->first() ? Storage::url($this->record->photos->first()->photo_path) : null)
                ->openUrlInNewTab()
                ->visible(fn () => $this->record->photos->isNotEmpty()),
        ];
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\Section::make('Detail Dokumentasi')
                    ->schema([
                        Infolists\Components\TextEntry::make('judul')
                            ->label('Judul')
                            ->weight('bold')
                            ->size('lg'),

                        Infolists\Components\TextEntry::make('user.name')
                            ->label('Mahasiswa')
                            ->badge()
                            ->color('primary')
                            ->visible(fn () => !auth()->user()->isMahasiswa()),

                        Infolists\Components\TextEntry::make('tanggal')
                            ->label('Tanggal')
                            ->date('d M Y')
                            ->badge()
                            ->color('info'),

                        Infolists\Components\TextEntry::make('keterangan')
                            ->label('Keterangan')
                            ->markdown()
                            ->columnSpanFull()
                            ->placeholder('Tidak ada keterangan'),
                    ])
                    ->columns(3)
                    ->collapsible(),

                Infolists\Components\Section::make('Galeri Foto')
                    ->description(count($this->record->photos) . ' foto')
                    ->schema([
                        Infolists\Components\Grid::make()
                            ->schema(
                                $this->record->photos->map(function ($photo) {
                                    return Infolists\Components\ImageEntry::make('photos.' . $photo->id)
                                        ->label($photo->caption ?? '')
                                        ->url(Storage::url($photo->photo_path))
                                        ->width('100%')
                                        ->height(200)
                                        ->extraImgAttributes([
                                            'class' => 'object-cover rounded-xl shadow-md hover:shadow-xl transition-shadow duration-300 cursor-pointer',
                                            'onclick' => "window.open('" . Storage::url($photo->photo_path) . "', '_blank')",
                                        ]);
                                })->toArray()
                            )
                            ->columns([
                                'default' => 1,
                                'sm' => 2,
                                'md' => 3,
                                'lg' => 4,
                            ]),
                    ])
                    ->collapsible(),
            ]);
    }
}
