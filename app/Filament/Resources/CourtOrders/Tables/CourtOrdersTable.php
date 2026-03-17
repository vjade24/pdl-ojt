<?php

namespace App\Filament\Resources\CourtOrders\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;

class CourtOrdersTable
{
    public static function configure(Table $table): Table
    {
        return $table
           ->columns([
    \Filament\Tables\Columns\TextColumn::make('case_no')
        ->searchable(),

    \Filament\Tables\Columns\TextColumn::make('order_category')
        ->badge(),

    \Filament\Tables\Columns\TextColumn::make('order_no'),

    \Filament\Tables\Columns\TextColumn::make('order_date')
        ->date('M d, Y'),

    \Filament\Tables\Columns\TextColumn::make('receive_date')
        ->dateTime('M d, Y'),
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
