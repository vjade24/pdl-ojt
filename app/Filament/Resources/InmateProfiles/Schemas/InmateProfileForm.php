<?php

namespace App\Filament\Resources\InmateProfiles\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
class InmateProfileForm
{
    public static function configure(Schema $schema): Schema
{
    return $schema
        ->columns(1)
        ->components([

            Section::make('Basic Information')
                ->columns([
                    'sm' => 1,
                    'md' => 2,
                    'xl' => 3,
                ])
                ->schema([

                    TextInput::make('pdl_number')
                        ->label('PDL Number')
                        ->required()
                        ->unique(ignoreRecord: true)
                        ->placeholder('Enter PDL number'),

                    DatePicker::make('birthdate')
                        ->required()
                        ->native(false)
                        ->displayFormat('m/d/Y'),

                    Select::make('sex')
                        ->options([
                            'Male' => 'Male',
                            'Female' => 'Female',
                        ])
                        ->required()
                        ->native(false),

                    TextInput::make('firstname')
                        ->required(),

                    TextInput::make('middlename'),

                    TextInput::make('lastname')
                        ->required(),

                    TextInput::make('suffix'),

                    Select::make('civil_status')
                        ->options([
                            'Single' => 'Single',
                            'Married' => 'Married',
                            'Widowed' => 'Widowed',
                            'Separated' => 'Separated',
                        ])
                        ->required()
                        ->native(false)
                        ->columnSpan(1),

                    TextInput::make('mother_name')
                        ->label("Mother's Name")
                        ->columnSpanFull(),

                    TextInput::make('father_name')
                        ->label("Father's Name")
                        ->columnSpanFull(),
                ])
                ->collapsible(),

           
            
            Section::make('Address Information')
    ->columns([
        'sm' => 1,
        'md' => 3,
    ])
    ->schema([

      
        Select::make('province_id')
            ->label('Province')
            ->relationship('province', 'province_name')
            ->searchable()
            ->preload()
            ->live()
            ->afterStateUpdated(function (Set $set) {
                $set('municipality_id', null);
                $set('barangay_id', null);
            })
            ->required(),

    
        Select::make('municipality_id')
            ->label('Municipality')
            ->options(function (Get $get) {
                return \App\Models\Municipality::query()
                    ->where('province_id', $get('province_id'))
                    ->pluck('municipality_name', 'id');
            })
            ->searchable()
            ->live()
            ->disabled(fn (Get $get) => ! $get('province_id'))
            ->afterStateUpdated(function (Set $set) {
                $set('barangay_id', null);
            })
            ->required(),

       
        Select::make('barangay_id')
            ->label('Barangay')
            ->options(function (Get $get) {
                return \App\Models\Barangay::query()
                    ->where('municipality_id', $get('municipality_id'))
                    ->pluck('barangay_name', 'id');
            })
            ->searchable()
            ->disabled(fn (Get $get) => ! $get('municipality_id'))
            ->required(),
    ])
    ->collapsible(),

          
            Section::make('Other Information')
                ->columns([
                    'sm' => 1,
                    'md' => 2,
                ])
                ->schema([

                    Select::make('religion_id')
                        ->relationship('religion', 'religion_name')
                        ->searchable()
                        ->preload()
                        ->required(),

                    Select::make('ethnicity_id')
                        ->relationship('ethnicity', 'ethnicity_name')
                        ->searchable()
                        ->preload()
                        ->required(),
                ])
                ->collapsible(),
        ]);
}
}