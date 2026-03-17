<?php

namespace App\Filament\Resources\EscortingSchedules\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class EscortingScheduleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([

                Section::make('Escorting Information')
                    ->columns(2)
                    ->schema([

                        Select::make('jailbook_id')
                            ->relationship('jailbook', 'case_no')
                            ->searchable()
                            ->required(),

                        Select::make('court_order_id')
                            ->relationship('courtOrder', 'order_no')
                            ->searchable(),

                        DatePicker::make('escort_date')
                            ->required(),

                        TimePicker::make('escort_time'),

                        TextInput::make('destination')
                            ->required(),

                        TextInput::make('purpose'),

                        TextInput::make('escorting_officer'),

                        Select::make('status')
                            ->options([
                                'Scheduled' => 'Scheduled',
                                'Completed' => 'Completed',
                                'Cancelled' => 'Cancelled',
                            ])
                            ->default('Scheduled')
                            ->required(),

                        Textarea::make('remarks')
                            ->columnSpanFull(),
                    ])
                    ->collapsible(),
            ]);
    }
}