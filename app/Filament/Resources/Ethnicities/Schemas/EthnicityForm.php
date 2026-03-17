<?php

namespace App\Filament\Resources\Ethnicities\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class EthnicityForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('ethnicity_name')
                    ->label('Ethnicity Name')
                    ->required()
                    ->maxLength(255),
            ]);
    }
}