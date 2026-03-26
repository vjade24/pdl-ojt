<?php

namespace App\Filament\Resources\Fingerprints\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

use Filament\Actions\ViewAction;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\ImageColumn;

class FingerprintsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
               

                TextColumn::make('inmate.full_name')
                    ->label('Inmate Name')
                    ->searchable(['firstname', 'lastname']),

                TextColumn::make('fingerprint_date')
                    ->date('M d, Y')
                    ->label('Date Taken')
                    ->sortable(),

                TextColumn::make('taken_by')
                    ->label('Taken By')
                    ->searchable(),
                
                
                TextColumn::make('specimens')
                    ->label('Fingers')
                    ->formatStateUsing(fn ($record) =>
                    $record->specimens->pluck('finger_name')->join(', ')
                    ),

  
             
                TextColumn::make('created_at')
                    ->dateTime('M d, Y'),


                TextColumn::make('created_at')
                    ->dateTime('M d, Y'),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}