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
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Components\Utilities\Get;

use App\Models\CourtOrder;

class JailbookForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([

               
                Section::make('Case Information')
                    ->columns(2)
                    ->schema([

                        Select::make('inmate_profile_id')
                            ->relationship('inmate', 'firstname')
                            ->getOptionLabelFromRecordUsing(fn ($record) =>
                                $record->firstname . ' ' . $record->middlename . ' ' . $record->lastname
                            )
                            ->required()
                            ->reactive(),
                           

                        Select::make('court_order_id')
                        ->label('Court Order')
                        ->relationship('courtOrder', 'order_no')
                        ->required()
                        ->reactive()
                        ->afterStateUpdated(function ($state, Set $set) {

                        $courtOrder = CourtOrder::find($state);

                        if ($courtOrder) {
          
                        $set('case_no', $courtOrder->case_no);

          
                        $set('court_id', $courtOrder->court_id);
                    }
                    }),
                        TextInput::make('case_no')
                            ->readOnly()
                            ->required(),

                        Select::make('court_id')
                        ->relationship('court', 'court_name')
    
                        ->dehydrated() 
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

           
                Section::make('Address Information')
                    ->columns(3)
                    ->schema([
                    
                        Select::make('add_province_name')
                            ->label('Province')
                            ->options(\App\Models\Province::pluck('province_name', 'province_name'))
                            ->searchable()
                            
                            ->reactive()
                            
                            ->afterStateUpdated(function (Set $set) {
                                $set('add_municipality_name', null);
                                $set('add_barangay_name', null);
                            })
                            ->required(),


                         Select::make('add_municipality_name')
                            ->label('Municipality')
                            ->options(function (Get $get) {

                            $province = $get('add_province_name');

                            return \App\Models\Municipality::query()
                             ->whereHas('province', fn ($q) =>
                            $q->where('province_name', $province)
                            )
                        ->pluck('municipality_name', 'municipality_name');
                         })
                            ->searchable()
                            ->reactive()
                            ->afterStateUpdated(fn (Set $set) => $set('add_barangay_name', null))
                            ->required(),

 
                        Select::make('add_barangay_name')
                            ->label('Barangay')
                            ->options(function (Get $get) {

                             $municipality = $get('add_municipality_name');

                            return \App\Models\Barangay::query()
                            ->whereHas('municipality', fn ($q) =>
                            $q->where('municipality_name', $municipality)
                            )
                        ->pluck('barangay_name', 'barangay_name');
                            })
                            ->searchable()
                            ->required(),

                        TextInput::make('address')
                            ->label('Purok/Street/Block/House no.')
                            ->columnSpanFull(),
                    ])
                    ->collapsible(),

              
                Section::make('Personal information')
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

       
                Section::make('Arrest & Processing')
                    ->columns(2)
                    ->schema([
                        DateTimePicker::make('date_received'),

                        TextInput::make('endorsing_officer'),
                        TextInput::make('receiving_officer'),
                        TextInput::make('chief_admin'),
                        TextInput::make('prov_warden'),

                        Textarea::make('circum_arrest')->columnSpanFull(),
                        Textarea::make('confiscated')->columnSpanFull(),
                        Textarea::make('completion')->columnSpanFull(),
                    ])
                    ->collapsible(),


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