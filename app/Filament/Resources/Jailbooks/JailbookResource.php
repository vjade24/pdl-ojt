<?php

namespace App\Filament\Resources\Jailbooks;

use App\Filament\Resources\Jailbooks\Pages\CreateJailbook;
use App\Filament\Resources\Jailbooks\Pages\EditJailbook;
use App\Filament\Resources\Jailbooks\Pages\ListJailbooks;
use App\Filament\Resources\Jailbooks\Schemas\JailbookForm;
use App\Filament\Resources\Jailbooks\Tables\JailbooksTable;
use App\Filament\Resources\Jailbooks\RelationManagers\FingerprintRelationManager;
use App\Filament\Resources\Jailbooks\RelationManagers\IdentifiedMarksRelationManager;

use App\Models\Jailbook;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class JailbookResource extends Resource
{
    protected static ?string $model = Jailbook::class;

    protected static string|UnitEnum|null $navigationGroup = 'Case Management';

    protected static ?int $navigationSort = 2;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBuildingLibrary;

    public static function form(Schema $schema): Schema
    {
        return JailbookForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return JailbooksTable::configure($table);
    }

    // ✅ REGISTER RELATION MANAGERS HERE
    public static function getRelations(): array
    {
        return [
            FingerprintRelationManager::class,
            IdentifiedMarksRelationManager::class,
        ];
    }

    public static function getPages(): array
{
    return [
        'index' => ListJailbooks::route('/'),
        'create' => CreateJailbook::route('/create'),
        'edit' => Pages\CustomEditJailbook::route('/{record}/edit'),
    ];
}
}