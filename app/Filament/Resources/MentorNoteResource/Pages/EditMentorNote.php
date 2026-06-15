<?php

namespace App\Filament\Resources\MentorNoteResource\Pages;

use App\Filament\Resources\MentorNoteResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMentorNote extends EditRecord
{
    protected static string $resource = MentorNoteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
