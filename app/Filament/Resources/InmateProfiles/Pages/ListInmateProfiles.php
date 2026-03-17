<?php

namespace App\Filament\Resources\InmateProfiles\Pages;

use App\Filament\Resources\InmateProfiles\InmateProfileResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListInmateProfiles extends ListRecords
{
    protected static string $resource = InmateProfileResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
