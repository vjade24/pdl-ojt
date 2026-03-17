<?php

namespace App\Filament\Resources\Jailbooks\Pages;

use App\Filament\Resources\Jailbooks\JailbookResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditJailbook extends EditRecord
{
    protected static string $resource = JailbookResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
