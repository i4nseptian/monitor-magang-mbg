<?php

namespace App\Filament\Resources\LogbookResource\Pages;

use App\Filament\Resources\LogbookResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLogbook extends EditRecord
{
    protected static string $resource = LogbookResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['photos'] = $this->record->photos->pluck('photo_path')->toArray();
        return $data;
    }

    protected function afterSave(): void
    {
        $photos = $this->form->getState()['photos'] ?? [];
        $existingPaths = $this->record->photos->pluck('photo_path')->toArray();

        $deletedPaths = array_diff($existingPaths, $photos);
        $this->record->photos()->whereIn('photo_path', $deletedPaths)->delete();

        $newPaths = array_diff($photos, $existingPaths);
        foreach ($newPaths as $photo) {
            $this->record->photos()->create([
                'photo_path' => $photo,
            ]);
        }
    }
}
