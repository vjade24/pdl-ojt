<?php

namespace App\Filament\Resources\Offenses\Pages;

use App\Filament\Resources\Offenses\OffenseResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditOffense extends EditRecord
{
    protected static string $resource = OffenseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
