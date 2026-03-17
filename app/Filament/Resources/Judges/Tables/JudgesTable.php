<?php

namespace App\Filament\Resources\Judges\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;

class JudgesTable
{
    public static function configure(Table $table): Table
    {
        return $table
          ->columns([
    \Filament\Tables\Columns\TextColumn::make('firstname')
        ->searchable()
        ->sortable(),

    \Filament\Tables\Columns\TextColumn::make('lastname')
        ->searchable()
        ->sortable(),

    \Filament\Tables\Columns\TextColumn::make('suffix'),

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
