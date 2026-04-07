<?php

namespace App\Filament\Resources\Jailbooks\RelationManagers;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;

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

     public $dots = [];

    /**
     * FORM
     */
    public function form(Schema $schema): Schema
    {
        return $schema->components([

           
            Hidden::make('marked_image')
                
                ->dehydrated(true),

          
            Hidden::make('dots')
                ->dehydrated(true),

            ViewField::make('body_marker')
                ->view('filament.components.body-marker')
                ->columnSpanFull(),

           
        ]);
    }

    /**
     * TABLE
     */
    public function table(Table $table): Table
    {
        return $table
            ->columns([

                ImageColumn::make('marked_image')
                    ->label('Marked Body')
                    ->height(80)
                    ->getStateUsing(fn ($record) => $record->marked_image 
                    ? url('storage/' . $record->marked_image) 
            : null
                ),

               

                TextColumn::make('created_at')
                    ->dateTime('M d, Y'),
            ])

                    ->headerActions([
               CreateAction::make()
        ->mutateFormDataUsing(function (array $data) {

        if (empty($this->dots)) {
            throw new \Exception('Please add at least one mark.');
        }

        $imagePath = public_path('images/body/combined.png');
        $image = imagecreatefrompng($imagePath);

        $width = imagesx($image);
        $height = imagesy($image);

       $yellow = imagecolorallocate($image, 255, 255, 0);
$black = imagecolorallocate($image, 0, 0, 0);

foreach ($this->dots as $index => $dot) {
    $x = $dot['x'] * $width;
    $y = $dot['y'] * $height;

    imagefilledellipse($image, $x, $y, 20, 20, $yellow);

    $number = (string) ($index + 1);

    imagestring(
        $image,
        5,
        $x - (strlen($number) * 4),
        $y - 8,
        $number,
        $black
    );
}

        $fileName = 'marks/' . uniqid() . '.png';
        $fullPath = storage_path('app/public/' . $fileName);

        imagepng($image, $fullPath);
        imagedestroy($image);

        $data['marked_image'] = $fileName;

       
        $data['mark_details'] = json_encode($this->dots);

        return $data;
    })
            ])

            ->recordActions([
                  ViewAction::make()
                    ->modalHeading('View Identified Mark')
                    ->form([
                ViewField::make('image_view')
                    ->view('filament.components.view-mark-image')
                    ->columnSpanFull(),               
        ]),
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