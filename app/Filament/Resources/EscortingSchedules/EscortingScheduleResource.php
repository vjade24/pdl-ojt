<?php

namespace App\Filament\Resources\EscortingSchedules;

use App\Filament\Resources\EscortingSchedules\Pages\CreateEscortingSchedule;
use App\Filament\Resources\EscortingSchedules\Pages\EditEscortingSchedule;
use App\Filament\Resources\EscortingSchedules\Pages\ListEscortingSchedules;
use App\Filament\Resources\EscortingSchedules\Schemas\EscortingScheduleForm;
use App\Filament\Resources\EscortingSchedules\Tables\EscortingSchedulesTable;
use App\Models\EscortingSchedule;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class EscortingScheduleResource extends Resource
{
    protected static ?string $model = EscortingSchedule::class;

    protected static string|UnitEnum|null $navigationGroup = 'Case Management';
    
    protected static ?int $navigationSort = 4;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedTruck;

    public static function form(Schema $schema): Schema
    {
        return EscortingScheduleForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return EscortingSchedulesTable::configure($table);
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
            'index' => ListEscortingSchedules::route('/'),
            'create' => CreateEscortingSchedule::route('/create'),
            'edit' => EditEscortingSchedule::route('/{record}/edit'),
        ];
    }
}
