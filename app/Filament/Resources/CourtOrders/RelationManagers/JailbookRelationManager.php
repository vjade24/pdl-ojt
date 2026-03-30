<?php

namespace App\Filament\Resources\CourtOrders\RelationManagers;

use App\Filament\Resources\Jailbooks\Schemas\JailbookForm;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
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
        return JailbookForm::configure($schema);
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
