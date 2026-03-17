<?php

namespace App\Filament\Resources\InmateProfiles\Pages;

use App\Filament\Resources\InmateProfiles\InmateProfileResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditInmateProfile extends EditRecord
{
    protected static string $resource = InmateProfileResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
