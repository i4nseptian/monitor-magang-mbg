<?php

namespace App\Filament\Resources\MentorNoteResource\Pages;

use App\Filament\Resources\MentorNoteResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMentorNotes extends ListRecords
{
    protected static string $resource = MentorNoteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
