<?php

namespace App\Filament\Resources\Courts\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;

class CourtsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
    \Filament\Tables\Columns\TextColumn::make('court_name')
        ->searchable()
        ->sortable(),

    \Filament\Tables\Columns\TextColumn::make('court_address')
        ->searchable(),

    \Filament\Tables\Columns\TextColumn::make('created_at')
        ->dateTime('M d, Y')
        ->label('Created'),
])
            ->filters([
                //
            ])
             ->recordActions([
  
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
