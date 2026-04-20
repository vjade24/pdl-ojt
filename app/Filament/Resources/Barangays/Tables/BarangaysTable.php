<?php

namespace App\Filament\Resources\Barangays\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn; 
class BarangaysTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('barangay_name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('municipality.municipality_name')
                    ->label('Municipality')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('municipality.province.province_name')
                    ->label('Province'),
            ])
            ->defaultSort('barangay_name')
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