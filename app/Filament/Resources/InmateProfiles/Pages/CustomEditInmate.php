<?php

namespace App\Filament\Resources\InmateProfiles\Pages;

use App\Filament\Resources\InmateProfiles\InmateProfileResource;
use Filament\Resources\Pages\EditRecord;

class CustomEditInmate extends EditRecord
{
    protected static string $resource = InmateProfileResource::class;

   
    protected string $view = 'filament.resources.inmate-profiles.custom-edit-inmate';

    protected function getHeaderActions(): array
    {
        return [
            //
        ];
    }
}