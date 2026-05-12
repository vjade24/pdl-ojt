<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Notifications\Notification;

use App\Models\Barangay;
use App\Models\Municipality;
use App\Models\Province;
use App\Models\Ethnicity;
use App\Models\Religion;
use App\Models\Court;
use App\Models\Judge;
use App\Models\Offense;
use App\Models\Station;

use App\Filament\Resources\Barangays\Schemas\BarangayForm;
use App\Filament\Resources\Municipalities\Schemas\MunicipalityForm;
use App\Filament\Resources\Provinces\Schemas\ProvinceForm;
use App\Filament\Resources\Ethnicities\Schemas\EthnicityForm;
use App\Filament\Resources\Religions\Schemas\ReligionForm;
use App\Filament\Resources\Courts\Schemas\CourtForm;
use App\Filament\Resources\Judges\Schemas\JudgeForm;
use App\Filament\Resources\Offenses\Schemas\OffenseForm;
use App\Filament\Resources\Stations\Schemas\StationForm;

use Filament\Schemas\Schema;

class Libraries extends Page
{
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-book-open';
    protected static ?string $navigationLabel = 'Libraries';
    protected static ?int $navigationSort = 1;

    protected string $view = 'filament.pages.libraries';

 
    public $court_name = '';
    public $editingCourtId = null;


    public $barangay_name = '';
    public $municipality_id = '';
    public $editingBarangayId = null;

    public function editCourt($id)
    {
        $court = Court::findOrFail($id);

        $this->editingCourtId = $court->id;
        $this->court_name = $court->court_name;
    }

    public function updateCourt()
{
    $this->validate([
        'court_name' => 'required|string|max:255',
    ]);

    Court::findOrFail($this->editingCourtId)->update([
        'court_name' => $this->court_name,
    ]);

    Notification::make()
        ->title('Success')
        ->body('Court updated successfully!')
        ->success()
        ->send();

    $this->reset(['court_name', 'editingCourtId']);
}

    public function deleteCourt($id)
{
    Court::findOrFail($id)->delete();

    Notification::make()
        ->title('Deleted')
        ->body('Court deleted successfully!')
        ->danger()
        ->send();
}


public function editBarangay($id)
{
    $barangay = Barangay::findOrFail($id);

    $this->editingBarangayId = $barangay->id;
    $this->barangay_name = $barangay->barangay_name;
    $this->municipality_id = $barangay->municipality_id;
}


// UPDATE BARANGAY
public function updateBarangay()
{
    $this->validate([
        'barangay_name' => 'required|string|max:255',
        'municipality_id' => 'required|exists:municipalities,id',
    ]);

    Barangay::findOrFail($this->editingBarangayId)->update([
        'barangay_name' => $this->barangay_name,
        'municipality_id' => $this->municipality_id,
    ]);

    Notification::make()
        ->title('Success')
        ->body('Barangay updated successfully!')
        ->success()
        ->send();

    $this->reset([
        'barangay_name',
        'municipality_id',
        'editingBarangayId'
    ]);
}


// DELETE BARANGAY
public function deleteBarangay($id)
{
    Barangay::findOrFail($id)->delete();

    Notification::make()
        ->title('Deleted')
        ->body('Barangay deleted successfully!')
        ->danger()
        ->send();
}



 

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
                        Barangay::create($data);

                        Notification::make()
                            ->title('Success')
                            ->body('Barangay added successfully!')
                            ->success()
                            ->send();
                    }),

                Action::make('viewBarangay')
                    ->label('View Barangays')
                    ->icon('heroicon-o-eye')
                    
                    ->modalHeading('Barangay List')
                    ->modalContent(view('filament.pages.modals.barangay-table', [
                        'barangays' => Barangay::with('municipality')->get()
                    ])),

               
                Action::make('addMunicipality')
                    ->label('Add Municipality')
                    ->icon('heroicon-o-building-office')
                    ->modalHeading('Create Municipality')
                    ->form(
                        MunicipalityForm::configure(Schema::make())->getComponents()
                    )
                    ->action(function (array $data) {
                        Municipality::create($data);

                Notification::make()
                    ->title('Success')
                    ->body('Municipality added successfully!')
                    ->success()
                    ->send();
                }),

                Action::make('viewMunicipality')
                    ->label('View Municipalities')
                    ->icon('heroicon-o-eye')
                   
                    ->modalHeading('Municipality List')
                    ->modalContent(view('filament.pages.modals.municipality-table', [
                        'municipalities' => Municipality::with('province')->get()
                    ])),

             
                Action::make('addProvince')
                    ->label('Add Province')
                    ->icon('heroicon-o-globe-alt')
                    ->modalHeading('Create Province')
                    ->form(
                        ProvinceForm::configure(Schema::make())->getComponents()
                    )
                    ->action(function (array $data) {
                    Province::create($data);

                Notification::make()
                ->title('Success')
                ->body('Province added successfully!')
                ->success()
                ->send();
            }),

                Action::make('viewProvince')
                    ->label('View Provinces')
                    ->modalHeading('Province List')
                    ->modalContent(view('filament.pages.modals.province-table', [
                        'provinces' => Province::all()
                    ])),

           
                Action::make('addEthnicity')
                    ->label('Add Ethnicity')
                    ->icon('heroicon-o-users')  
                    ->modalHeading('Create Ethnicity')
                    ->form(
                        EthnicityForm::configure(Schema::make())->getComponents()
                    )
                    ->action(function (array $data) {
                Ethnicity::create($data);

                Notification::make()
                    ->title('Success')
                    ->body('Ethnicity added successfully!')
                    ->success()
                    ->send();
            }), 

                Action::make('viewEthnicity')
                    ->label('View Ethnicities')
                    ->modalHeading('Ethnicity List')
                    ->modalContent(view('filament.pages.modals.ethnicity-table', [
                        'ethnicities' => Ethnicity::all()
                    ])),

                Action::make('addReligion')
                    ->label('Add Religion')
                    ->icon('heroicon-o-book-open')
                    ->modalHeading('Create Religion')
                    ->form(
                        ReligionForm::configure(Schema::make())->getComponents()
                    )
                    ->action(function (array $data) {
                        Religion::create($data);

                        Notification::make()
                            ->title('Success')
                            ->body('Religion added successfully!')
                            ->success()
                            ->send();
                    }),

                Action::make('viewReligion')
                    ->label('View Religions')
                    ->modalHeading('Religion List')
                    ->modalContent(view('filament.pages.modals.religion-table', [
                        'religions' => Religion::all()
                    ])),

                Action::make('addCourt')
                    ->label('Add Court')
                    ->icon('heroicon-o-scale')  
                    ->modalHeading('Create Court')
                    ->form(
                        CourtForm::configure(Schema::make())->getComponents()
                    )
                    ->action(function (array $data) {
                        Court::create($data);

                        Notification::make()
                            ->title('Success')
                            ->body('Court added successfully!')
                            ->success()
                            ->send();
                    }),

                Action::make('viewCourt')
                    ->label('View Courts')
                    ->modalHeading('Court List')
                    ->modalContent(view('filament.pages.modals.court-table', [
                        'courts' => Court::all()
                    ])),

             
                Action::make('addJudge')
                    ->label('Add Judge')
                    ->icon('heroicon-o-user-circle')
                    ->modalHeading('Create Judge')
                    ->form(
                        JudgeForm::configure(Schema::make())->getComponents()
                    )
                    ->action(function (array $data) {
                        Judge::create($data);

                        Notification::make()
                            ->title('Success')
                            ->body('Judge added successfully!')
                            ->success()
                            ->send();
                    }),

                Action::make('viewJudge')
                    ->label('View Judges')
                    ->modalHeading('Judge List')
                    ->modalContent(view('filament.pages.modals.judge-table', [
                        'judges' => Judge::all()
                    ])),

                Action::make('addOffense')
                    ->label('Add Offense')
                    ->icon('heroicon-o-shield-exclamation')
                    ->modalHeading('Create Offense')
                    ->form(
                        OffenseForm::configure(Schema::make())->getComponents()
                    )
                    ->action(function (array $data) {
                        Offense::create($data);

                        Notification::make()
                            ->title('Success')
                            ->body('Offense added successfully!')
                            ->success()
                            ->send();
                    }),

                Action::make('viewOffense')
                    ->label('View Offenses')
                    ->modalHeading('Offense List')
                    ->modalContent(view('filament.pages.modals.offense-table', [
                        'offenses' => Offense::all()
                    ])),

                Action::make('addStation')
                    ->label('Add Station')
                    ->icon('heroicon-o-building-office-2') 
                    ->modalHeading('Create Station')
                    ->form(
                        StationForm::configure(Schema::make())->getComponents()
                    )
                    ->action(function (array $data) {
                Station::create($data);

                Notification::make()
                    ->title('Success')
                    ->body('Station added successfully!')
                    ->success()
                ->send();
              }),

                Action::make('viewStation')
                    ->label('View Stations')
                    ->modalHeading('Station List')
                    ->modalContent(view('filament.pages.modals.station-table', [
                        'stations' => Station::all()
                    ])),

            ])
                ->label('')
                ->icon('heroicon-o-ellipsis-vertical')
                ->color('gray'),
        ];
    }



    protected function getViewData(): array
    {
        return [
            'barangayCount' => Barangay::count(),
            'municipalityCount' => Municipality::count(),
            'provinceCount' => Province::count(),
            'ethnicityCount' => Ethnicity::count(),
            'religionCount' => Religion::count(),
            'courtCount' => Court::count(),
            'judgeCount' => Judge::count(),
            'offenseCount' => Offense::count(),
            'stationCount' => Station::count(),
        ];
    }
}