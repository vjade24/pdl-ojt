<?php

namespace App\Filament\Resources\CourtOrders\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CourtOrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([

                Section::make('Court Order Information')
                    ->columns(2)
                    ->schema([

                        TextInput::make('case_no')
                            ->required(),

                        TextInput::make('order_no'),

                        Select::make('order_category')
                            ->options([
                                'Commitment Order' => 'Commitment Order',
                                'Office Memo Resolutions' => 'Office Memo Resolutions',
                                'Subpoena' => 'Subpoena',
                                'Discharge Order' => 'Discharge Order',
                                'Escorting Order' => 'Escorting Order',
                                'Sentence Order' => 'Sentence Order',
                            ])
                            ->required(),

                        DatePicker::make('order_date')
                            ->required(),

                        DateTimePicker::make('receive_date'),

                        TextInput::make('receive_by'),

                        TextInput::make('approved_by'),

                        DateTimePicker::make('approved_date'),

                        FileUpload::make('attachment')
                            ->multiple()
                            ->directory('court-orders')
                            ->downloadable()
                            ->previewable(),
                    ])
                    ->collapsible(),
            ]);
    }
}