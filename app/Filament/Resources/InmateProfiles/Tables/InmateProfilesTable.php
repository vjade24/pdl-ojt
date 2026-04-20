<?php

namespace App\Filament\Resources\InmateProfiles\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\ViewAction;
use Filament\Actions\Action;
class InmateProfilesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

            TextColumn::make('inmate_id')
            ->label('ID')
            ->limit(20),


           TextColumn::make('fullname')
            ->label('Full Name')
            ->getStateUsing(fn ($record) => 
            trim("{$record->firstname} {$record->middlename} {$record->lastname}")
            )
            ->searchable()
            ->sortable(),

            TextColumn::make('sex'),

            TextColumn::make('civil_status'),           

            TextColumn::make('skills')
                ->limit(20),

            

           
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
        ->tooltip('Edit'),

    Action::make('print')
    ->icon('heroicon-m-printer')
    ->color('success')
    ->button()
    ->label('')
    ->tooltip('Print')
    ->url(fn ($record) => route('report.pdf', [
        'inmate_id' => $record->id,
        'id' => $record->jailbook->id ?? null,
    ]))
    ->openUrlInNewTab(),

])
        ->toolbarActions([
            BulkActionGroup::make([
                DeleteBulkAction::make(),
            ]),
            ]);
    }
        }
