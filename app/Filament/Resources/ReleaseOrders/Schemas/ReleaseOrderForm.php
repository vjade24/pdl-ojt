<?php

namespace App\Filament\Resources\ReleaseOrders\Schemas;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Forms\Get;
use Filament\Schemas\Components\Utilities\Set;

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
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(function ($state, Set $set) {

                                $jailbook = \App\Models\Jailbook::find($state);
                                if ($jailbook) {
                                    $set('court_order_id', $jailbook->court_order_id);
                                    $set('judge_id', $jailbook->judge_id);
                                }
                            }),
                        Select::make('judge_id')
                           ->relationship('judge', 'id') 
                           ->getOptionLabelFromRecordUsing(fn ($record) => 
                             "{$record->firstname} {$record->middlename} {$record->lastname} {$record->suffix}"
                                )
                           ->required(),

                        Select::make('court_order_id')
                            ->relationship('courtOrder', 'order_no')
                            ->disabled()
                            ->dehydrated()
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