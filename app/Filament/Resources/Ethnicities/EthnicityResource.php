<?php

namespace App\Filament\Resources\Ethnicities;

use App\Filament\Resources\Ethnicities\Pages\CreateEthnicity;
use App\Filament\Resources\Ethnicities\Pages\EditEthnicity;
use App\Filament\Resources\Ethnicities\Pages\ListEthnicities;
use App\Filament\Resources\Ethnicities\Schemas\EthnicityForm;
use App\Filament\Resources\Ethnicities\Tables\EthnicitiesTable;
use App\Models\Ethnicity;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class EthnicityResource extends Resource
{
    protected static ?string $model = Ethnicity::class;

    protected static string|UnitEnum|null $navigationGroup = 'Inmate Classification';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUsers;

    public static function form(Schema $schema): Schema
    {
        return EthnicityForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return EthnicitiesTable::configure($table);
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
            'index' => ListEthnicities::route('/'),
            'create' => CreateEthnicity::route('/create'),
            'edit' => EditEthnicity::route('/{record}/edit'),
        ];
    }
}
