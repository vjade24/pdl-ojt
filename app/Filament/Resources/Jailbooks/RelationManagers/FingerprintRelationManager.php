<?php

namespace App\Filament\Resources\Jailbooks\RelationManagers;

use App\Filament\Resources\Fingerprints\FingerprintResource;
use Filament\Actions\AssociateAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DissociateAction;
use Filament\Actions\DissociateBulkAction;
use Filament\Actions\EditAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class FingerprintRelationManager extends RelationManager
{
    protected static string $relationship = 'fingerprint';

    public function form(Schema $schema): Schema
    {
        return FingerprintResource::form($schema);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('fingerprint_date')
            ->columns([
                TextColumn::make('fingerprint_date')
                    ->searchable(),
            ])
            ->headerActions([
                CreateAction::make()
                    ->after(function ($record, $livewire) {
                        // 🔥 redirect to edit page after create
                        return redirect()->to(
                            FingerprintResource::getUrl('edit', ['record' => $record])
                        );
                    }),

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