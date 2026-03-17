<?php

namespace App\Filament\Resources\Ethnicities\Pages;

use App\Filament\Resources\Ethnicities\EthnicityResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListEthnicities extends ListRecords
{
    protected static string $resource = EthnicityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
