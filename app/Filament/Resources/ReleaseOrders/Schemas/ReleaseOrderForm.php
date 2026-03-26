<?php

namespace App\Filament\Resources\ReleaseOrders\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ReleaseOrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([

                Section::make('Release Information')
                    ->columns(2)
                    ->schema([

                        Select::make('jailbook_id')
                            ->relationship('jailbook', 'case_no')
                            
                            ->required(),

                        Select::make('court_order_id')
                            ->relationship('courtOrder', 'order_no')
                            
                            ->required(),

                        DatePicker::make('release_date')
                            ->required(),

                        Select::make('status')
                            ->options([
                                'Pending' => 'Pending',
                                'Approved' => 'Approved',
                                'Released' => 'Released',
                            ])
                            ->default('Pending')
                            ->required(),

                        TextInput::make('release_reason'),

                        TextInput::make('received_by'),

                        TextInput::make('approved_by'),

                        Textarea::make('remarks')
                            ->columnSpanFull(),
                    ])
                    ->collapsible(),
            ]);
    }
}