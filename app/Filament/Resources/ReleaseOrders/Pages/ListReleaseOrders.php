<?php

namespace App\Filament\Resources\ReleaseOrders\Pages;

use App\Filament\Resources\ReleaseOrders\ReleaseOrderResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListReleaseOrders extends ListRecords
{
    protected static string $resource = ReleaseOrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
