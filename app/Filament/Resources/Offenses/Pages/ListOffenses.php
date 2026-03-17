<?php

namespace App\Filament\Resources\Offenses\Pages;

use App\Filament\Resources\Offenses\OffenseResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListOffenses extends ListRecords
{
    protected static string $resource = OffenseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
