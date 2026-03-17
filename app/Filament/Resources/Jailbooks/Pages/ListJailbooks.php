<?php

namespace App\Filament\Resources\Jailbooks\Pages;

use App\Filament\Resources\Jailbooks\JailbookResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListJailbooks extends ListRecords
{
    protected static string $resource = JailbookResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
