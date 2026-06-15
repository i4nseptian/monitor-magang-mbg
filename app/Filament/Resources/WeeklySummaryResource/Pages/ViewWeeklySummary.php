<?php

namespace App\Filament\Resources\WeeklySummaryResource\Pages;

use App\Filament\Resources\WeeklySummaryResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewWeeklySummary extends ViewRecord
{
    protected static string $resource = WeeklySummaryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
