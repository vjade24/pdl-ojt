<?php

namespace App\Filament\Resources\InmateProfiles\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\ViewAction;
class InmateProfilesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('pdl_number')
                    ->label('PDL #')
                    ->searchable()
                    ->sortable()
                    ->copyable(),

           TextColumn::make('fullname')
            ->label('Full Name')
            ->getStateUsing(fn ($record) => 
            trim("{$record->firstname} {$record->middlename} {$record->lastname}")
            )
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
            
            TextColumn::make('place_of_birth')
                ->limit(20),

            

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
            
        ])
        ->recordActions([
        EditAction::make(),
        ViewAction::make(),

       
       
    ])
        ->toolbarActions([
            BulkActionGroup::make([
                DeleteBulkAction::make(),
            ]),
            ]);
    }
        }
