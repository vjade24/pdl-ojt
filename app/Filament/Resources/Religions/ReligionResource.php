<?php

namespace App\Filament\Resources\Religions;

use App\Filament\Resources\Religions\Pages\CreateReligion;
use App\Filament\Resources\Religions\Pages\EditReligion;
use App\Filament\Resources\Religions\Pages\ListReligions;
use App\Filament\Resources\Religions\Schemas\ReligionForm;
use App\Filament\Resources\Religions\Tables\ReligionsTable;
use App\Models\Religion;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ReligionResource extends Resource
{
    protected static ?string $model = Religion::class;

    protected static string|UnitEnum|null $navigationGroup = 'Inmate Classification';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedSparkles;

    public static function form(Schema $schema): Schema
    {
        return ReligionForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ReligionsTable::configure($table);
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
            'index' => ListReligions::route('/'),
            'create' => CreateReligion::route('/create'),
            'edit' => EditReligion::route('/{record}/edit'),
        ];
    }
}
