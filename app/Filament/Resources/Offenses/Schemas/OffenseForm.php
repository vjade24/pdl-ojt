<?php

namespace App\Filament\Resources\Offenses\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class OffenseForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Textarea::make('offense_descr')
                    ->label('Offense Description')
                    ->required()
                    ->rows(4)
                    ->columnSpanFull(),
            ]);
    }
}