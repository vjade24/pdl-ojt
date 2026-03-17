<?php

namespace App\Filament\Resources\Offenses;

use App\Filament\Resources\Offenses\Pages\CreateOffense;
use App\Filament\Resources\Offenses\Pages\EditOffense;
use App\Filament\Resources\Offenses\Pages\ListOffenses;
use App\Filament\Resources\Offenses\Schemas\OffenseForm;
use App\Filament\Resources\Offenses\Tables\OffensesTable;
use App\Models\Offense;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class OffenseResource extends Resource
{
    protected static ?string $model = Offense::class;

    protected static string|UnitEnum|null $navigationGroup = 'Jail Management';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedExclamationTriangle;

    public static function form(Schema $schema): Schema
    {
        return OffenseForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return OffensesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListOffenses::route('/'),
            'create' => CreateOffense::route('/create'),
            'edit' => EditOffense::route('/{record}/edit'),
        ];
    }
}
