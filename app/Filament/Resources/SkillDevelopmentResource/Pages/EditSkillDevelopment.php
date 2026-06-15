<?php

namespace App\Filament\Resources\SkillDevelopmentResource\Pages;

use App\Filament\Resources\SkillDevelopmentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSkillDevelopment extends EditRecord
{
    protected static string $resource = SkillDevelopmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
