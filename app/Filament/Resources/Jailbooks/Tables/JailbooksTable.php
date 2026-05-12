<?php

namespace App\Filament\Resources\Jailbooks\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Actions\ViewAction;
use Filament\Actions\Action;
use Illuminate\View\View;


class JailbooksTable
{
    public static function configure(Table $table, bool $hideInmate = false): Table
    {
        return $table
            ->columns([
    \Filament\Tables\Columns\TextColumn::make('inmate.full_name')
        ->label('Inmate')
        ->searchable()
        ->visible(! $hideInmate),

    \Filament\Tables\Columns\TextColumn::make('case_no')->label('Case #'),

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
        ->tooltip('Edit'),
        
    Action::make('print_report')
        ->button()
        ->label('')
        // ->tooltip(fn ($record) => $record->jailbook ? 'View report' : 'No report available')
        // ->disabled(fn ($record) => blank($record->jailbook?->id))
        ->modalHeading('Inmate Report')
        ->modalCancelActionLabel('Close')
        ->icon('heroicon-m-printer')
        ->color('success')
        ->modalCloseButton(false)
        ->modalFooterActions()
        ->modalSubmitAction(false)
        ->modalWidth('5xl')
        ->slideOver()
        ->closeModalByClickingAway(false)
        ->modalContent(fn ($record): View => view(
            'livewire.report-viewer',
            [
                'report_iframe' => config('app.jasper_url').'/jasperserver/flow.html?pp=u%3DJamshasadid%7Cr%3DManager%7Co%3DEMEA,Sales%7Cpa1%3DSweden&_flowId=viewReportFlow&_flowId=viewReportFlow&ParentFolderUri=%2Freports%2FPDL&reportUnit=%2Freports%2FPDL%2Fjail_booking_report&standAlone=true&decorate=no&output=pdf&inmate_id='.$record->inmate_profile_id.'&jailbooks_id='.$record->id
            ],
        )),
    ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
