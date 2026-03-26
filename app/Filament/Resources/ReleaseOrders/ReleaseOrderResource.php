<?php

namespace App\Filament\Resources\ReleaseOrders;

use App\Filament\Resources\ReleaseOrders\Pages\CreateReleaseOrder;
use App\Filament\Resources\ReleaseOrders\Pages\EditReleaseOrder;
use App\Filament\Resources\ReleaseOrders\Pages\ListReleaseOrders;
use App\Filament\Resources\ReleaseOrders\Schemas\ReleaseOrderForm;
use App\Filament\Resources\ReleaseOrders\Tables\ReleaseOrdersTable;
use App\Models\ReleaseOrder;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ReleaseOrderResource extends Resource
{
    protected static ?string $model = ReleaseOrder::class;

    protected static string|UnitEnum|null $navigationGroup = 'Case Management';

    protected static ?int $navigationSort = 6;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentCheck;

    public static function form(Schema $schema): Schema
    {
        return ReleaseOrderForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ReleaseOrdersTable::configure($table);
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
            'index' => ListReleaseOrders::route('/'),
            'create' => CreateReleaseOrder::route('/create'),
            'edit' => EditReleaseOrder::route('/{record}/edit'),
        ];
    }
}
