<?php

namespace App\Filament\Resources\SkillDevelopmentResource\Pages;

use App\Filament\Resources\SkillDevelopmentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSkillDevelopments extends ListRecords
{
    protected static string $resource = SkillDevelopmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
