<?php

namespace App\Filament\Resources\Fingerprints\RelationManagers;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Actions\CreateAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\BulkActionGroup;

class SpecimensRelationManager extends RelationManager
{
    protected static string $relationship = 'specimens';

    protected static ?string $recordTitleAttribute = 'finger_name';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([

                Select::make('finger_name')
                    ->options([
                        'Right Thumb' => 'Right Thumb',
                        'Right Index' => 'Right Index',
                        'Right Middle' => 'Right Middle',
                        'Right Ring' => 'Right Ring',
                        'Right Little' => 'Right Little',
                        'Left Thumb' => 'Left Thumb',
                        'Left Index' => 'Left Index',
                        'Left Middle' => 'Left Middle',
                        'Left Ring' => 'Left Ring',
                        'Left Little' => 'Left Little',
                    ])
                    ->required(),

                FileUpload::make('fingerprint_image')
                    ->image()
                    ->directory('fingerprints')
                    ->imagePreviewHeight('150')
                    ->downloadable()
                    ->required(),

                Textarea::make('remarks')
                    ->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('finger_name')
                    ->badge()
                    ->searchable(),

                ImageColumn::make('fingerprint_image')
                    ->label('Fingerprint')
                    ->square(),

                TextColumn::make('created_at')
                    ->dateTime('M d, Y'),
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

    public static function getTab(): ?string
    {
    return 'specimens';
    }
}