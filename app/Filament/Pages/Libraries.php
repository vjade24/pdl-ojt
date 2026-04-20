<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use App\Models\Barangay;
use App\Models\Municipality;
use App\Models\Province;
use App\Models\Ethnicity;
use App\Filament\Resources\Barangays\Schemas\BarangayForm;
use App\Filament\Resources\Municipalities\Schemas\MunicipalityForm;
use App\Filament\Resources\Provinces\Schemas\ProvinceForm;
use App\Filament\Resources\Ethnicities\Schemas\EthnicityForm;
use Filament\Schemas\Schema;
use Filament\Actions\ActionGroup;
class Libraries extends Page
{
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-book-open';
    protected static ?string $navigationLabel = 'Libraries';
    protected static ?int $navigationSort = 1;

    protected string $view = 'filament.pages.libraries';

    protected function getHeaderActions(): array
{
    return [

        ActionGroup::make([

            Action::make('addBarangay')
                ->label('Add Barangay')
                ->icon('heroicon-o-map')
                ->modalHeading('Create Barangay')
                ->form(
                    BarangayForm::configure(Schema::make())->getComponents()
                )
                ->action(function (array $data) {

                    \App\Models\Barangay::create($data);

                    Notification::make()
                        ->title('Barangay created successfully')
                        ->success()
                        ->send();
                }),

            Action::make('viewBarangay')
                        ->label('View Barangays')
                        ->icon('heroicon-o-eye')
                        ->modalHeading('Barangay List')
                        ->modalContent(view('filament.pages.modals.barangay-table', [
                        'barangays' => \App\Models\Barangay::with('municipality')->get()
                    ])),

            Action::make('addMunicipality')
                ->label('Add Municipality')
                ->icon('heroicon-o-building-office')
                ->modalHeading('Create Municipality')
                ->form(
                    MunicipalityForm::configure(Schema::make())->getComponents()
                )
                ->action(function (array $data) {

                    \App\Models\Municipality::create($data);

                    Notification::make()
                        ->title('Municipality created successfully')
                        ->success()
                        ->send();
                }),

            Action::make('viewMunicipality')
                ->label('View Municipalities')
                ->icon('heroicon-o-eye')
                ->modalHeading('Municipality List')
                ->modalContent(view('filament.pages.modals.municipality-table', [
                'municipalities' => \App\Models\Municipality::with('province')->get()
            ])),

            Action::make('addProvince')
                ->label('Add Province')
                ->icon('heroicon-o-globe-alt')
                ->modalHeading('Create Province')
                ->form(
                    ProvinceForm::configure(Schema::make())->getComponents()
                )
                ->action(function (array $data) {

                    \App\Models\Province::create($data);

            Notification::make()
                ->title('Province created successfully')
                ->success()
                ->send();
                }),

            Action::make('viewProvince')
                ->label('View Provinces')
                ->icon('heroicon-o-eye')
                ->modalHeading('Province List')
                ->modalContent(view('filament.pages.modals.province-table', [
                'provinces' => \App\Models\Province::all()
                ])),

            Action::make('addEthnicity')
                ->label('Add Ethnicity')
                ->icon('heroicon-o-user-group')
                ->modalHeading('Create Ethnicity')
                ->form(
                EthnicityForm::configure(Schema::make())->getComponents()
                )
                ->action(function (array $data) {

        \App\Models\Ethnicity::create($data);

        Notification::make()
            ->title('Ethnicity created successfully')
            ->success()
            ->send();
    }),

            Action::make('viewEthnicity')
            ->label('View Ethnicities')
            ->icon('heroicon-o-eye')
            ->modalHeading('Ethnicity List')
            ->modalContent(view('filament.pages.modals.ethnicity-table', [
        'ethnicities' => \App\Models\Ethnicity::all()
            ])),

            ])

        
        ->label('') 
        ->icon('heroicon-o-ellipsis-vertical') 
        ->color('gray')

    ];
}
    protected function getViewData(): array
    {
        return [
            'barangayCount' => Barangay::count(),
            'municipalityCount' => Municipality::count(),
            'provinceCount' => Province::count(),
            'ethnicityCount' => Ethnicity::count(),
        ];
    }
}