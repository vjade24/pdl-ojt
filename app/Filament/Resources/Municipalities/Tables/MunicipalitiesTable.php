<?php

namespace App\Filament\Resources\Municipalities\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;

class MunicipalitiesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
    \Filament\Tables\Columns\TextColumn::make('municipality_name')
        ->searchable()
        ->sortable(),

    \Filament\Tables\Columns\TextColumn::make('province.province_name')
        ->label('Province')
        ->searchable()
        ->sortable(),

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
