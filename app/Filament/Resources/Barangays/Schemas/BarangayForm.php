<?php

namespace App\Filament\Resources\Barangays\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
 use App\Models\Municipality;
class BarangayForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                TextInput::make('barangay_name')
                    ->required()
                    ->maxLength(255),

               

Select::make('municipality_id')
    ->label('Municipality')
    ->options(Municipality::pluck('municipality_name', 'id'))
    ->required(),

            ]);
    }
}