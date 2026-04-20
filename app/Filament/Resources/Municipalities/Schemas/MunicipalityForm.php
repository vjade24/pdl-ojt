<?php

namespace App\Filament\Resources\Municipalities\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use App\Models\Province;
class MunicipalityForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                TextInput::make('municipality_name')
                    ->label('Municipality Name')
                    ->required()
                    ->maxLength(255),

              

Select::make('province_id')
    ->label('Province')
    ->options(Province::pluck('province_name', 'id'))
    ->searchable()
    ->required(),

                
            ]);
    }
}