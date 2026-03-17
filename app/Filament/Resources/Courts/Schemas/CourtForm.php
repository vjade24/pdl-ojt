<?php

namespace App\Filament\Resources\Courts\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class CourtForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('court_name')
                    ->label('Court Name')
                    ->required()
                    ->maxLength(255),

                TextInput::make('court_address')
                    ->label('Court Address')
                    ->maxLength(255),
            ]);
    }
}