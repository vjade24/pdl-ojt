<?php

namespace App\Filament\Resources\ReleaseOrders\Pages;

use App\Filament\Resources\ReleaseOrders\ReleaseOrderResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditReleaseOrder extends EditRecord
{
    protected static string $resource = ReleaseOrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
