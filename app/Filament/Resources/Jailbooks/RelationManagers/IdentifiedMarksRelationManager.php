<?php

namespace App\Filament\Resources\Jailbooks\RelationManagers;

use Illuminate\Support\Facades\Storage;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;

use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\ViewField;

use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Table;

class IdentifiedMarksRelationManager extends RelationManager
{
    protected static string $relationship = 'identifiedMarks';

    protected static ?string $recordTitleAttribute = 'marks';

    /**
     * Save marked image per view (front, back, right, left)
     */
    public function saveMarkedImage($base64)
    {
        $image = str_replace('data:image/png;base64,', '', $base64);
        $image = str_replace(' ', '+', $image);

        $fileName = 'marks/' . uniqid() . '.png';

        Storage::disk('public')->put($fileName, base64_decode($image));

        $view = $this->form->getState()['view_type'] ?? null;

        if ($view) {
            $this->form->fill([
                "{$view}_image" => $fileName,
            ]);
        }

        return $fileName;
    }

    /**
     * Form
     */
    public function form(Schema $schema): Schema
    {
        return $schema->components([

            // still optional (can remove if unused)
            Hidden::make('marked_image')->dehydrated(true),

            Hidden::make('view_type'),

            ViewField::make('body_marker')
                ->view('filament.components.body-marker')
                ->columnSpanFull(),

            Textarea::make('marks')
                ->label('Description')
                ->required()
                ->columnSpanFull(),
        ]);
    }

    /**
     * Table
     */
    public function table(Table $table): Table
    {
        return $table
            ->columns([

                ImageColumn::make('front_image')
                    ->label('Front')
                    ->disk('public')
                    ->height(60)
                    ->extraImgAttributes(['style' => 'cursor:pointer'])
                    ->url(fn ($record) => $record->front_image
                        ? asset('storage/' . $record->front_image)
                        : null,
                        true
                    ),

                ImageColumn::make('back_image')
                    ->label('Back')
                    ->disk('public')
                    ->height(60)
                    ->extraImgAttributes(['style' => 'cursor:pointer'])
                    ->url(fn ($record) => $record->back_image
                        ? asset('storage/' . $record->back_image)
                        : null,
                        true
                    ),

                ImageColumn::make('right_image')
                    ->label('Right')
                    ->disk('public')
                    ->height(60)
                    ->extraImgAttributes(['style' => 'cursor:pointer'])
                    ->url(fn ($record) => $record->right_image
                        ? asset('storage/' . $record->right_image)
                        : null,
                        true
                    ),

                ImageColumn::make('left_image')
                    ->label('Left')
                    ->disk('public')
                    ->height(60)
                    ->extraImgAttributes(['style' => 'cursor:pointer'])
                    ->url(fn ($record) => $record->left_image
                        ? asset('storage/' . $record->left_image)
                        : null,
                        true
                    ),

                TextColumn::make('marks')
                    ->wrap()
                    ->searchable(),

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
}