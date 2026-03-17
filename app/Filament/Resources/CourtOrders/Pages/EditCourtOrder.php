<?php

namespace App\Filament\Resources\CourtOrders\Pages;

use App\Filament\Resources\CourtOrders\CourtOrderResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditCourtOrder extends EditRecord
{
    protected static string $resource = CourtOrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
