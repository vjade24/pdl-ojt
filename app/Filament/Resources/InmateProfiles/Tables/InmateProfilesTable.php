<?php

namespace App\Filament\Resources\InmateProfiles\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
class InmateProfilesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

            TextColumn::make('pdl_number')
                ->label('PDL Number')
                ->searchable()
                ->sortable(),

            TextColumn::make('firstname')
                ->searchable()
                ->sortable(),

            TextColumn::make('middlename')
                ->searchable(),

            TextColumn::make('lastname')
                ->searchable()
                ->sortable(),

            TextColumn::make('suffix'),

            TextColumn::make('birthdate')
                ->date('m/d/Y')
                ->sortable(),

            TextColumn::make('sex'),

            TextColumn::make('civil_status'),

            TextColumn::make('mother_name')
                ->limit(20),

            TextColumn::make('father_name')
                ->limit(20),

            TextColumn::make('province.province_name')
                ->label('Province')
                ->sortable()
                ->searchable(),

            TextColumn::make('municipality.municipality_name')
                ->label('Municipality')
                ->sortable()
                ->searchable(),

            TextColumn::make('barangay.barangay_name')
                ->label('Barangay')
                ->sortable()
                ->searchable(),

            TextColumn::make('religion.religion_name')
                ->label('Religion')
                ->sortable()
                ->searchable(),

            TextColumn::make('ethnicity.ethnicity_name')
                ->label('Ethnicity')
                ->sortable()
                ->searchable(),
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
