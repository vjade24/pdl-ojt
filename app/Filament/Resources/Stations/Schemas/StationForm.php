<?php

namespace App\Filament\Resources\Stations\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class StationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('station_name')
                    ->label('Station Name')
                    ->required()
                    ->maxLength(255),

                TextInput::make('station_address')
                    ->label('Station Address')
                    ->maxLength(255),
            ]);
    }
}