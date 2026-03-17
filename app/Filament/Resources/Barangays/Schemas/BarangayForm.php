<?php

namespace App\Filament\Resources\Barangays\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class BarangayForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('municipality_id')
                    ->relationship('municipality', 'municipality_name')
                    ->searchable()
                    ->required(),

                TextInput::make('barangay_name')
                    ->required()
                    ->maxLength(255),
            ]);
    }
}