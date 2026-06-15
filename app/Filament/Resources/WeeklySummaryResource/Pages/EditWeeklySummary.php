<?php

namespace App\Filament\Resources\WeeklySummaryResource\Pages;

use App\Filament\Resources\WeeklySummaryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWeeklySummary extends EditRecord
{
    protected static string $resource = WeeklySummaryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
