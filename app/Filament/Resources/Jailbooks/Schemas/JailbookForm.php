<?php

namespace App\Filament\Resources\Jailbooks\Schemas;

use App\Filament\Resources\CourtOrders\Schemas\CourtOrderForm;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;

use App\Models\CourtOrder;
use App\Models\Jailbook;
use Illuminate\Validation\Rule;

class JailbookForm
{
    public static function configure(Schema $schema, bool $hideInmate = false, ?int $selectedInmateId = null): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Tabs::make('Tabs')
                    ->columnSpanFull()
                    ->tabs([

                        Tab::make('Case Information')
                            ->icon('heroicon-o-scale')
                            ->columns(3)
                            ->schema([

                                Select::make('inmate_profile_id')
                                    ->relationship('inmate', 'firstname')
                                    ->getOptionLabelFromRecordUsing(fn ($record) =>
                                        $record->firstname . ' ' . $record->middlename . ' ' . $record->lastname
                                    )
                                    ->default($selectedInmateId)
                                    ->formatStateUsing(fn ($state) => $state ?: $selectedInmateId)
                                    ->required()
                                    ->disabled($hideInmate)
                                    ->dehydrated()
                                    ->reactive()
                                    ->rules([
                                        fn (Get $get, $record) => Rule::unique(Jailbook::class, 'inmate_profile_id')
                                            ->where('court_order_id', $get('court_order_id'))
                                            ->ignore($record?->id),
                                    ]),

                                Select::make('court_order_id')
                                    ->label('Court Order')
                                    ->relationship('courtOrder', 'order_no')
                                    ->required()
                                    ->reactive()
                                    ->afterStateUpdated(function ($state, Set $set) {
                                        $courtOrder = CourtOrder::find($state);
                                        if ($courtOrder) {
                                            $set('case_no', $courtOrder->case_no);
                                        }
                                    })
                                    ->createOptionForm(
                                        CourtOrderForm::getFormComponents()
                                    )
                                    ,

                                TextInput::make('case_no')
                                    ->readOnly()
                                    ->required(),

                                Select::make('court_id')
                                    ->label('Court Name')
                                    ->relationship('court', 'court_name')
                                    ->searchable()
                                    ->preload()
                                    ->required()
                                    ->createOptionForm([
                                        TextInput::make('court_name')
                                            ->label('Court Name')
                                            ->required(),
                                    ]),

                                Select::make('judge_id')
                                    ->relationship('judge', 'lastname')
                                    ->getOptionLabelFromRecordUsing(fn ($record) =>
                                        trim("{$record->firstname} {$record->middlename} {$record->lastname} {$record->suffix}")
                                    )
                                    ->searchable()
                                    ->preload()
                                    ->required()
                                    ->createOptionForm([
                                        TextInput::make('lastname')->label('Last Name')->required(),
                                        TextInput::make('firstname')->label('First Name')->required(),
                                        TextInput::make('middlename')->label('Middle Name'),
                                        TextInput::make('suffix')->label('Suffix'),
                                    ]),

                                Select::make('station_id')
                                    ->relationship('station', 'station_name')
                                    ->searchable()
                                    ->preload()
                                    ->required()
                                    ->createOptionForm([
                                        TextInput::make('station_name')
                                            ->label('Station Name')
                                            ->required(),
                                    ]),

                                Select::make('offense_id')
                                    ->relationship('offense', 'offense_descr')
                                    ->required()
                                    ->preload()
                                    ->createOptionForm([
                                        TextInput::make('offense_descr')
                                            ->label('Offense Description')
                                            ->required(),
                                    ])
                                    ->columnSpanFull(),
                            ]),
                        Tab::make('Personal Information')
                            ->icon('heroicon-o-user')
                            ->columns(3)
                            ->schema([
                                Select::make('civilStatus')
                                    ->label('Civil Status')
                                    ->options([
                                        'Single' => 'Single',
                                        'Married' => 'Married',
                                        'Widowed' => 'Widowed',
                                        'Separated' => 'Separated',
                                        'Annulled' => 'Annulled',
                                        'Divorced' => 'Divorced',
                                    ])
                                    ->required(),
                                TextInput::make('height'),
                                TextInput::make('weight'),
                                TextInput::make('hair'),
                                TextInput::make('alias'),
                                TextInput::make('complexion'),
                                TextInput::make('occupation'),
                                TextInput::make('place_visited'),
                                TextInput::make('educ_attainment')->label('Educational Attainment'),
                                TextInput::make('wife_husb_name')->label('Wife/Husband Name')->columnSpanFull(),
                                TextInput::make('wife_husb_add')->label('Wife/Husband Address')->columnSpanFull(),

                                Toggle::make('father_decease_tag')->columnSpan(1)->label('Father Deceased'),
                                Toggle::make('mother_decease_tag')->columnSpan(1)->label('Mother Deceased'),

                            ]),
                        Tab::make('Address Information')
                            ->icon('heroicon-o-map-pin')
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
                            ]),

                        

                        Tab::make('Arrest & Processing')
                            ->icon('heroicon-o-shield-exclamation')
                            ->columns(2)
                            ->schema([
                                DateTimePicker::make('date_received')->columnSpanFull(),

                                TextInput::make('endorsing_officer'),
                                TextInput::make('receiving_officer'),
                                TextInput::make('chief_admin'),
                                TextInput::make('prov_warden'),

                                Textarea::make('circum_arrest')->columnSpanFull(),
                                Textarea::make('confiscated')->columnSpanFull(),
                                Textarea::make('completion')->columnSpanFull(),
                            ]),

                        Tab::make('Detention Information')
                            ->icon('heroicon-o-lock-closed')
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
                            ]),

                    ]),
            ]);
    }
}