<?php

namespace App\Filament\Resources\InmateProfiles\Pages;

use App\Filament\Resources\InmateProfiles\InmateProfileResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

use App\Filament\Resources\InmateProfiles\RelationManagers\JailbookRelationManager;
use App\Filament\Resources\InmateProfiles\RelationManagers\FingerprintRelationManager;


class ViewInmateProfile extends ViewRecord
{
    protected static string $resource = InmateProfileResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }

    public function form(\Filament\Schemas\Schema $schema): \Filament\Schemas\Schema
    {
        return $schema->components([]);
    }

    public function getRelationManagers(): array
    {
        return [
            JailbookRelationManager::class,
          
        ];
    }

    public function hasCombinedRelationManagerTabsWithContent(): bool
    {
        return true;
    }
}