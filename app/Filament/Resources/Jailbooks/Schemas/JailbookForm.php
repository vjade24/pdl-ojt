<?php

namespace App\Filament\Resources\Jailbooks\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class JailbookForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([

                // =========================
                Section::make('Case Information')
                    ->columns(2)
                    ->schema([

                        Select::make('inmate_profile_id')
                            ->relationship('inmate', 'pdl_number')
                            ->searchable()
                            ->required(),

                        TextInput::make('case_no')
                            ->required(),

                        Select::make('court_id')
                            ->relationship('court', 'court_name')
                            ->required(),

                        Select::make('judge_id')
                            ->relationship('judge', 'lastname')
                            ->required(),

                        Select::make('station_id')
                            ->relationship('station', 'station_name')
                            ->required(),

                        Select::make('offense_id')
                            ->relationship('offense', 'offense_descr')
                            ->required(),
                    ])
                    ->collapsible(),

                // =========================
                Section::make('Address Snapshot')
                    ->columns(3)
                    ->schema([

                        Select::make('add_province_id')
                            ->relationship('province', 'province_name')
                            ->required(),

                        Select::make('add_municipality_id')
                            ->relationship('municipality', 'municipality_name')
                            ->required(),

                        Select::make('add_barangay_id')
                            ->relationship('barangay', 'barangay_name')
                            ->required(),

                        TextInput::make('address')
                            ->columnSpanFull(),
                    ])
                    ->collapsible(),

                // =========================
                Section::make('Personal Snapshot')
                    ->columns(3)
                    ->schema([

                        TextInput::make('civilStatus'),
                        TextInput::make('height'),
                        TextInput::make('weight'),
                        TextInput::make('hair'),
                        TextInput::make('alias'),
                        TextInput::make('complexion'),
                        TextInput::make('occupation'),

                        Toggle::make('father_decease_tag'),
                        Toggle::make('mother_decease_tag'),

                        TextInput::make('wife_husb_name'),
                        TextInput::make('wife_husb_add'),
                        TextInput::make('educ_attainment'),
                        TextInput::make('place_visited'),
                    ])
                    ->collapsible(),

                // =========================
                Section::make('Arrest & Processing')
                    ->columns(2)
                    ->schema([

                        DateTimePicker::make('date_received'),

                        TextInput::make('endorsing_officer'),
                        TextInput::make('receiving_officer'),
                        TextInput::make('chief_admin'),
                        TextInput::make('prov_warden'),

                        Textarea::make('circum_arrest')
                            ->columnSpanFull(),

                        Textarea::make('confiscated')
                            ->columnSpanFull(),

                        Textarea::make('completion')
                            ->columnSpanFull(),
                    ])
                    ->collapsible(),

                // =========================
                Section::make('Detention Information')
                    ->columns(2)
                    ->schema([

                        DatePicker::make('detention_from'),
                        DatePicker::make('detention_to'),

                        Select::make('status')
                            ->options([
                                'Detained' => 'Detained',
                                'Released' => 'Released',
                                'Transferred' => 'Transferred',
                            ])
                            ->default('Detained')
                            ->required(),
                    ])
                    ->collapsible(),
            ]);
    }
}