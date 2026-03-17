<?php

namespace App\Filament\Resources\Fingerprints\Pages;

use App\Filament\Resources\Fingerprints\FingerprintResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListFingerprints extends ListRecords
{
    protected static string $resource = FingerprintResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
