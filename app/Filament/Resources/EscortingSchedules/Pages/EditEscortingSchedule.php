<?php

namespace App\Filament\Resources\EscortingSchedules\Pages;

use App\Filament\Resources\EscortingSchedules\EscortingScheduleResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditEscortingSchedule extends EditRecord
{
    protected static string $resource = EscortingScheduleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
