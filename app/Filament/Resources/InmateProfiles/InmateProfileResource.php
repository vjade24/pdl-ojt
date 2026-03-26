<?php

namespace App\Filament\Resources\InmateProfiles;

use App\Filament\Resources\InmateProfiles\Pages\CreateInmateProfile;
use App\Filament\Resources\InmateProfiles\Pages\EditInmateProfile;
use App\Filament\Resources\InmateProfiles\Pages\ListInmateProfiles;
use App\Filament\Resources\InmateProfiles\Schemas\InmateProfileForm;
use App\Filament\Resources\InmateProfiles\Tables\InmateProfilesTable;
use App\Models\InmateProfile;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use App\Filament\Resources\InmateProfiles\RelationManagers\JailbookRelationManager;
use App\Filament\Resources\InmateProfiles\RelationManagers\FingerprintRelationManager;
use App\Filament\Resources\InmateProfiles\Pages\ViewInmateProfile;
class InmateProfileResource extends Resource
{
    protected static ?string $model = InmateProfile::class;

    protected static string|UnitEnum|null $navigationGroup = 'Case Management';

    protected static ?int $navigationSort = 1;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedIdentification;

    public static function form(Schema $schema): Schema
    {
        return InmateProfileForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return InmateProfilesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            JailbookRelationManager::class,
            FingerprintRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListInmateProfiles::route('/'),
            'create' => CreateInmateProfile::route('/create'),
            'edit' => EditInmateProfile::route('/{record}/edit'),
            'view' => ViewInmateProfile::route('/{record}')
            
        ];
    }
}
