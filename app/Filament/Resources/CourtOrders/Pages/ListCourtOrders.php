<?php

namespace App\Filament\Resources\CourtOrders\Pages;

use App\Filament\Resources\CourtOrders\CourtOrderResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCourtOrders extends ListRecords
{
    protected static string $resource = CourtOrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
