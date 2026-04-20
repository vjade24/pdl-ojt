<?php

namespace App\Filament\Resources\Jailbooks\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Actions\ViewAction;


class JailbooksTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
    \Filament\Tables\Columns\TextColumn::make('inmate.full_name')
        ->label('Inmate')
        ->searchable(),

    \Filament\Tables\Columns\TextColumn::make('case_no'),

    \Filament\Tables\Columns\TextColumn::make('courtOrder.order_category')
    ->label('Order Category'),

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
                
            ])
            ->recordActions([
    ViewAction::make()
        ->icon('heroicon-m-eye')
        ->color('info')
        ->button()
        ->label('')
        ->tooltip('View'),
       

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
