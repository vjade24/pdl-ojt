<?php

namespace App\Filament\Resources\Religions\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ReligionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('religion_name')
                    ->label('Religion Name')
                    ->required()
                    ->maxLength(255),
            ]);
    }
}