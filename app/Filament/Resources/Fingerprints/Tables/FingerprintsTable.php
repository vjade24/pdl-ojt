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
                TextColumn::make('jailbook.case_no')
                    ->label('Jailbook')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('fingerprint_date')
                    ->date('M d, Y')
                    ->label('Date Taken')
                    ->sortable(),

                TextColumn::make('taken_by')
                    ->label('Taken By')
                    ->searchable(),

  
             
                TextColumn::make('created_at')
                    ->dateTime('M d, Y'),


                TextColumn::make('created_at')
                    ->dateTime('M d, Y'),
            ])
            ->recordActions([
                 ViewAction::make()
                     ->icon('heroicon-m-eye')
                     ->color('info')
                     ->button()
                     ->label('')
                     ->tooltip('View'),

                 EditAction::make()
                     ->icon('heroicon-m-pencil-square')
                     ->color('primary')
                     ->button()
                     ->label('')
                     ->tooltip('Edit')
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}