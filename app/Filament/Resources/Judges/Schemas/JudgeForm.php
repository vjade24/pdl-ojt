<?php

namespace App\Filament\Resources\Judges\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class JudgeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('firstname')
                    ->required()
                    ->maxLength(255),

                TextInput::make('middlename')
                    ->maxLength(255),

                TextInput::make('lastname')
                    ->required()
                    ->maxLength(255),

                TextInput::make('suffix')
                    ->maxLength(50),
            ]);
    }
}