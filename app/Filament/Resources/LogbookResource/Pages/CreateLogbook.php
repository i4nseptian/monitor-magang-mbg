<?php

namespace App\Filament\Resources\LogbookResource\Pages;

use App\Filament\Resources\LogbookResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateLogbook extends CreateRecord
{
    protected static string $resource = LogbookResource::class;

    protected function afterCreate(): void
    {
        $photos = $this->form->getState()['photos'] ?? [];
        foreach ($photos as $photo) {
            $this->record->photos()->create([
                'photo_path' => $photo,
            ]);
        }
    }
}
