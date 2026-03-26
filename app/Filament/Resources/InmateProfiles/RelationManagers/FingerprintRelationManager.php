<?php

namespace App\Filament\Resources\InmateProfiles\RelationManagers;

use Filament\Actions\AssociateAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DissociateAction;
use Filament\Actions\DissociateBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class FingerprintRelationManager extends RelationManager
{
    protected static string $relationship = 'fingerprint';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('inmate_profile_id')
                    ->required()
                    ->numeric(),
                DatePicker::make('fingerprint_date'),
                TextInput::make('taken_by'),
                Textarea::make('remarks')
                    ->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('taken_by')
            ->columns([
              
                TextColumn::make('fingerprint_date')
                    ->date()
                    ->sortable(),
                TextColumn::make('taken_by')
                    ->searchable(),
                 TextColumn::make('specimens')
                    ->label('Fingers')
                     ->formatStateUsing(fn ($record) =>
            $record->specimens->pluck('finger_name')->join(', ')
                 ),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make(),
                AssociateAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DissociateAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DissociateBulkAction::make(),
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
