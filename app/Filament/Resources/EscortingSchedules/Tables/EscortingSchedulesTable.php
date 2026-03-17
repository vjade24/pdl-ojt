<?php

namespace App\Filament\Resources\EscortingSchedules\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;

class EscortingSchedulesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
    \Filament\Tables\Columns\TextColumn::make('jailbook.case_no')
        ->label('Case No'),

    \Filament\Tables\Columns\TextColumn::make('escort_date')
        ->date('M d, Y'),

    \Filament\Tables\Columns\TextColumn::make('destination'),

    \Filament\Tables\Columns\TextColumn::make('status')
        ->badge()
        ->colors([
            'primary' => 'Scheduled',
            'success' => 'Completed',
            'danger' => 'Cancelled',
        ]),
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
