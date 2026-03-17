<?php

namespace App\Filament\Resources\Fingerprints\Pages;

use App\Filament\Resources\Fingerprints\FingerprintResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditFingerprint extends EditRecord
{
    protected static string $resource = FingerprintResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
