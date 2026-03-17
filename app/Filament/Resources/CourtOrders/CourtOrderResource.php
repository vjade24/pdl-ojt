<?php

namespace App\Filament\Resources\CourtOrders;

use App\Filament\Resources\CourtOrders\Pages\CreateCourtOrder;
use App\Filament\Resources\CourtOrders\Pages\EditCourtOrder;
use App\Filament\Resources\CourtOrders\Pages\ListCourtOrders;
use App\Filament\Resources\CourtOrders\Schemas\CourtOrderForm;
use App\Filament\Resources\CourtOrders\Tables\CourtOrdersTable;
use App\Models\CourtOrder;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class CourtOrderResource extends Resource
{
    protected static ?string $model = CourtOrder::class;

    protected static string|UnitEnum|null $navigationGroup = 'Case Management';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentText;

    public static function form(Schema $schema): Schema
    {
        return CourtOrderForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CourtOrdersTable::configure($table);
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
            'index' => ListCourtOrders::route('/'),
            'create' => CreateCourtOrder::route('/create'),
            'edit' => EditCourtOrder::route('/{record}/edit'),
        ];
    }
}
