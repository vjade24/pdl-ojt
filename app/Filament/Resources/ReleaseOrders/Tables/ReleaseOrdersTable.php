<?php

namespace App\Filament\Resources\ReleaseOrders\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;

class ReleaseOrdersTable
{
    public static function configure(Table $table): Table
    {
        return $table
           ->columns([
    \Filament\Tables\Columns\TextColumn::make('jailbook.case_no')
        ->label('Case No'),

    \Filament\Tables\Columns\TextColumn::make('courtOrder.order_no')
        ->label('Order No'),

    \Filament\Tables\Columns\TextColumn::make('release_date')
        ->date('M d, Y'),

    \Filament\Tables\Columns\TextColumn::make('status')
        ->badge()
        ->colors([
            'warning' => 'Pending',
            'success' => 'Released',
            'primary' => 'Approved',
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
