<?php

namespace App\Filament\Resources\InmateProfiles\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\ViewAction;
use Filament\Actions\Action;
use Illuminate\View\View;

class InmateProfilesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

           TextColumn::make('fullname')
            ->label('Full Name')
            ->getStateUsing(fn ($record) => 
            trim("{$record->firstname} {$record->middlename} {$record->lastname}")
            )
            ->searchable()
            ->sortable()
            ->description( fn ($record) => $record->place_of_birth),
            TextColumn::make('sex'),
            TextColumn::make('civil_status'),           
            TextColumn::make('ethnicity.ethnicity_name'),
            TextColumn::make('religion.religion_name'),
            TextColumn::make('jailbooks.offense.offense_descr')
                ->listWithLineBreaks()
                ->limitList(1)
                ->expandableLimitedList()
                ->badge()
                ->wrap(),

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
    ->tooltip(fn ($record) => $record->jailbook ? 'View report' : 'No report available')
    ->disabled(fn ($record) => blank($record->jailbook?->id))
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
            'report_iframe' => config('app.jasper_url').'/jasperserver/flow.html?pp=u%3DJamshasadid%7Cr%3DManager%7Co%3DEMEA,Sales%7Cpa1%3DSweden&_flowId=viewReportFlow&_flowId=viewReportFlow&ParentFolderUri=%2Freports%2FPDL&reportUnit=%2Freports%2FPDL%2Fjail_booking_report&standAlone=true&decorate=no&output=pdf&inmate_id='.$record->id.'&jailbooks_id='
        ],
    )),
    // Action::make('print')
    // ->icon('heroicon-m-printer')
    // ->color('success')
    // ->button()
    // ->label('')
    // ->tooltip('Print')
    // ->url(fn ($record) => route('report.pdf', [
    //     'inmate_id' => $record->id,
    //     'id' => $record->jailbook->id ?? null,
    // ]))
    // ->openUrlInNewTab(),

])
        ->toolbarActions([
            BulkActionGroup::make([
                DeleteBulkAction::make(),
            ]),
            ]);
    }
        }
