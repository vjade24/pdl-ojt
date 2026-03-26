<?php

namespace App\Filament\Resources\InmateProfiles\RelationManagers;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class JailbookRelationManager extends RelationManager
{
    protected static string $relationship = 'jailbooks';

    protected static ?string $title = 'Jailbooks';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([

                // Case Info
                TextInput::make('case_no')
                    ->label('Case Number')
                    ->required(),

                TextInput::make('status')
                    ->default('Detained')
                    ->required(),

                DateTimePicker::make('date_received')
                    ->label('Date Received'),

                // Personal Details
                TextInput::make('alias'),
                TextInput::make('address'),
                TextInput::make('civilStatus'),
                TextInput::make('occupation'),

                // Physical Info
                TextInput::make('height'),
                TextInput::make('weight'),
                TextInput::make('hair'),
                TextInput::make('complexion'),

                // Family Info
                Toggle::make('father_decease_tag')
                    ->label('Father Deceased'),

                Toggle::make('mother_decease_tag')
                    ->label('Mother Deceased'),

                TextInput::make('wife_husb_name'),
                TextInput::make('wife_husb_add'),

                // Education & Travel
                TextInput::make('educ_attainment'),
                TextInput::make('place_visited'),

                // Officers
                TextInput::make('endorsing_officer'),
                TextInput::make('receiving_officer'),
                TextInput::make('chief_admin'),
                TextInput::make('prov_warden'),

                // Dates
                DatePicker::make('detention_from'),
                DatePicker::make('detention_to'),

                // Notes
                Textarea::make('circum_arrest')->columnSpanFull(),
                Textarea::make('confiscated')->columnSpanFull(),
                Textarea::make('completion')->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('case_no')
            ->columns([
                TextColumn::make('case_no')
                    ->label('Case No')
                    ->searchable(),

                TextColumn::make('status')
                    ->badge()
                    ->color(fn ($state) => match ($state) {
                        'Detained' => 'warning',
                        'Released' => 'success',
                        default => 'gray',
                    }),

                TextColumn::make('date_received')
                    ->dateTime()
                    ->label('Received'),

                TextColumn::make('endorsing_officer')
                    ->label('Officer'),

                IconColumn::make('father_decease_tag')
                    ->label('Father')
                    ->boolean(),

                IconColumn::make('mother_decease_tag')
                    ->label('Mother')
                    ->boolean(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}