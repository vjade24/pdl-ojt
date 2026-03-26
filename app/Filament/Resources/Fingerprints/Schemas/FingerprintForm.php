<?php

namespace App\Filament\Resources\Fingerprints\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class FingerprintForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->components([

                Select::make('inmate_profile_id')
                    ->relationship('inmate', 'firstname')
                    
                    ->required(),

                DatePicker::make('fingerprint_date'),

                TextInput::make('taken_by'),

                Textarea::make('remarks')
                    ->columnSpanFull(),
            ]);
    }
}