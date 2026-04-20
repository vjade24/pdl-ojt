<?php

namespace App\Filament\Resources\Jailbooks\Pages;

use App\Filament\Resources\Jailbooks\JailbookResource;
use Filament\Resources\Pages\EditRecord;

class CustomEditJailbook extends EditRecord
{
    protected static string $resource = JailbookResource::class;

    // ✅ Custom Blade View
    protected string $view = 'filament.resources.jailbook.custom-edit-jailbook';

    /**
     * Page Title
     */
    public function getTitle(): string
    {
        return 'Edit Jailbook Record';
    }

    /**
     * Success Notification
     */
    protected function getSavedNotificationTitle(): ?string
    {
        return 'Record updated successfully!';
    }

    /**
     * OPTIONAL: Redirect after save
     */
    public function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    /**
     * 🔥 IMPORTANT: Ensure relations load properly
     */
    public function getRelationManagers(): array
    {
        return $this->getResource()::getRelations();
    }
}