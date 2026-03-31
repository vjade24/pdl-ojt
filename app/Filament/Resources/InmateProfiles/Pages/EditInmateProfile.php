<?php

namespace App\Filament\Resources\InmateProfiles\Pages;

use App\Filament\Resources\InmateProfiles\InmateProfileResource;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Validation\ValidationException;
use App\Models\InmateProfile;

class EditInmateProfile extends EditRecord
{
    protected static string $resource = InmateProfileResource::class;

   
    public function getRelationManagers(): array
{
    return [
        \App\Filament\Resources\InmateProfiles\RelationManagers\JailbookRelationManager::class,       
    ];
}

    
    protected function beforeSave(): void
    {
        $data = $this->form->getState();

        $exists = InmateProfile::where('firstname', $data['firstname'])
            ->where('lastname', $data['lastname'])
            ->where('middlename', $data['middlename'])
            ->where('birthdate', $data['birthdate'])
            ->where('id', '!=', $this->record->id)
            ->exists();

        if ($exists) {
            throw ValidationException::withMessages([
                'data.firstname' => 'This inmate already exists.',
            ]);
        }
    }

    public function getTitle(): string
    {
    return $this->record->firstname . ' ' .
           $this->record->middlename . ' ' .
           $this->record->lastname;
    }
    }