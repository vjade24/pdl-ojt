<?php

namespace App\Filament\Resources\Ethnicities\Pages;

use App\Filament\Resources\Ethnicities\EthnicityResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditEthnicity extends EditRecord
{
    protected static string $resource = EthnicityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
