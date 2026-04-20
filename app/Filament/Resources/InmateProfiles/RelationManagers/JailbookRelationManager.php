<?php

namespace App\Filament\Resources\InmateProfiles\RelationManagers;

use App\Filament\Resources\Jailbooks\JailbookResource;
use App\Filament\Resources\Jailbooks\Tables\JailbooksTable;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

use App\Filament\Resources\Jailbooks\Schemas\JailbookForm;

class JailbookRelationManager extends RelationManager
{
    protected static string $relationship = 'jailbooks';

    protected static ?string $title = 'Jailbooks';

    public function form(Schema $schema): Schema
    {
        return JailbookForm::configure($schema);
    }

    public function table(Table $table): Table
    {
        return JailbooksTable::configure($table, hideInmate: true)
            ->headerActions([
                CreateAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }
}