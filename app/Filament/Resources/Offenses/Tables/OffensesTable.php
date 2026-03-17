<?php

namespace App\Filament\Resources\Offenses\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;

class OffensesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
    \Filament\Tables\Columns\TextColumn::make('offense_descr')
        ->label('Offense')
        ->limit(50)
        ->searchable(),

    \Filament\Tables\Columns\TextColumn::make('created_at')
        ->dateTime('M d, Y')
        ->label('Created'),
])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
