<?php

namespace App\Filament\Resources\DocumentationResource\Pages;

use App\Filament\Resources\DocumentationResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDocumentation extends CreateRecord
{
    protected static string $resource = DocumentationResource::class;

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
