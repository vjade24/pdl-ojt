<?php

namespace App\Filament\Resources\Fingerprints;

use App\Filament\Resources\Fingerprints\Pages\CreateFingerprint;
use App\Filament\Resources\Fingerprints\Pages\EditFingerprint;
use App\Filament\Resources\Fingerprints\Pages\ListFingerprints;
use App\Filament\Resources\Fingerprints\Schemas\FingerprintForm;
use App\Filament\Resources\Fingerprints\Tables\FingerprintsTable;
use App\Filament\Resources\Fingerprints\RelationManagers\SpecimensRelationManager;
use App\Models\Fingerprint;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class FingerprintResource extends Resource
{
    protected static ?string $model = Fingerprint::class;

    protected static string|UnitEnum|null $navigationGroup = 'Case Management';

    protected static ?int $navigationSort = 5;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedFingerPrint;

    public static function form(Schema $schema): Schema
    {
        return FingerprintForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return FingerprintsTable::configure($table);
    }


    public static function getRelations(): array
{
    return [
        \App\Filament\Resources\Fingerprints\RelationManagers\SpecimensRelationManager::class,
    ];
}

    public static function getPages(): array
{
    return [
        'index' => Pages\ListFingerprints::route('/'),
        'create' => Pages\CreateFingerprint::route('/create'),
        'edit' => Pages\EditFingerprint::route('/{record}/edit'),
        
    ];
}
}
