<?php

namespace App\Filament\Resources\Jailbooks\Pages;

use App\Filament\Resources\Jailbooks\JailbookResource;
use Filament\Resources\Pages\CreateRecord;

class CreateJailbook extends CreateRecord
{
    protected static string $resource = JailbookResource::class;

    protected function getRedirectUrl(): string
{
    return route('filament.admin.resources.jailbooks.edit', $this->record);
}
}