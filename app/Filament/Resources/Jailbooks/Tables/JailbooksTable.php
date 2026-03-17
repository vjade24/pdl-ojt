<?php

namespace App\Filament\Resources\Jailbooks\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;

class JailbooksTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
    \Filament\Tables\Columns\TextColumn::make('inmate.full_name')
        ->label('Inmate'),

    \Filament\Tables\Columns\TextColumn::make('case_no'),

    \Filament\Tables\Columns\TextColumn::make('offense.offense_descr')
        ->limit(30),

    \Filament\Tables\Columns\TextColumn::make('court.court_name'),

    \Filament\Tables\Columns\TextColumn::make('status')
        ->badge()
        ->colors([
            'danger' => 'Detained',
            'success' => 'Released',
            'warning' => 'Transferred',
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
