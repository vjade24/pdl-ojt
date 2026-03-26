<?php

namespace App\Filament\Resources\InmateProfiles\Schemas;

use App\Models\InmateProfile;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class InmateProfileForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([

                // 🔹 BASIC INFORMATION
                Section::make('Basic Information')
                    ->description('Personal details of the inmate')
                    ->collapsible()
                    ->collapsed() // 👈 collapsed by default
                    ->columns([
                        'sm' => 1,
                        'md' => 2,
                        'xl' => 3,
                    ])
                    ->schema([

                        TextInput::make('pdl_number')
                            ->label('PDL Number')
                            ->default(function () {
                                $latest = InmateProfile::orderBy('id', 'desc')->value('pdl_number');
                                if (! $latest) {
                                    return 'PDL-00001';
                                }
                                $number = (int) preg_replace('/\D/', '', $latest) + 1;
                                return 'PDL-' . str_pad($number, 5, '0', STR_PAD_LEFT);
                            })
                            ->disabled()
                            ->dehydrated()
                            ->required()
                            ->columnSpanFull(),

                        TextInput::make('firstname')
                            ->label('First Name')
                            ->required(),

                        TextInput::make('lastname')
                            ->label('Last Name')
                            ->required(),

                        TextInput::make('middlename')
                            ->label('Middle Name'),

                        DatePicker::make('birthdate')
                            ->label('Birthdate')
                            ->required()
                            ->native(false)
                            ->displayFormat('m/d/Y'),

                        Select::make('sex')
                            ->label('Sex')
                            ->options([
                                'Male' => 'Male',
                                'Female' => 'Female',
                            ])
                            ->required()
                            ->native(false),

                        Select::make('suffix')
                            ->label('Suffix')
                            ->options([
                                'Jr' => 'Jr',
                                'Sr' => 'Sr',
                                'III' => 'III',
                                'IV' => 'IV',
                                'V' => 'V',
                            ])
                            ->native(false),

                        Select::make('civil_status')
                            ->label('Civil Status')
                            ->options([
                                'Single' => 'Single',
                                'Married' => 'Married',
                                'Widowed' => 'Widowed',
                                'Separated' => 'Separated',
                            ])
                            ->required()
                            ->native(false),

                        TextInput::make('mother_name')
                            ->label("Mother's Name")
                            ->columnSpanFull(),

                        TextInput::make('father_name')
                            ->label("Father's Name")
                            ->columnSpanFull(),
                    ]),

               
                    Section::make('Place of Birth')
                            ->description('Birth location of the inmate')
                            ->collapsible()
                            ->collapsed()
                            ->columns([
                            'sm' => 1,
                            'md' => 2,
                    ])
                    ->schema([
                   TextInput::make('place_of_birth')
                    ->label('Place of Birth')
                    ->placeholder('e.g. Davao City, Philippines')
                    ->required()
                    ->columnSpanFull(),

                        ]),

               
                Section::make('Other Information')
                    ->description('Additional classification details')
                    ->collapsible()
                    ->collapsed()
                    ->columns([
                        'sm' => 1,
                        'md' => 2,
                    ])
                    ->schema([

                        Select::make('religion_id')
                            ->label('Religion')
                            ->relationship('religion', 'religion_name')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->createOptionForm([
                                TextInput::make('religion_name')
                                    ->label('Religion Name')
                                    ->required(),
                            ]),

                        Select::make('ethnicity_id')
                            ->label('Ethnicity')
                            ->relationship('ethnicity', 'ethnicity_name')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->createOptionForm([
                                TextInput::make('ethnicity_name')
                                    ->label('Ethnicity Name')
                                    ->required(),
                            ]),
                    ]),
            ]);
    }
}