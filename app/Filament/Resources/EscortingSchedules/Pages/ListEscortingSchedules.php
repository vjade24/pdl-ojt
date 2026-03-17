<?php

namespace App\Filament\Resources\EscortingSchedules\Pages;

use App\Filament\Resources\EscortingSchedules\EscortingScheduleResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListEscortingSchedules extends ListRecords
{
    protected static string $resource = EscortingScheduleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
