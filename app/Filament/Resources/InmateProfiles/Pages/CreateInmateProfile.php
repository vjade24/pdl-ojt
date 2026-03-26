<?php

namespace App\Filament\Resources\InmateProfiles\Pages;

use App\Filament\Resources\InmateProfiles\InmateProfileResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Validation\ValidationException;
use App\Models\InmateProfile;

class CreateInmateProfile extends CreateRecord
{
    protected static string $resource = InmateProfileResource::class;

    protected function beforeCreate(): void
    {
        $data = $this->form->getState();

        $exists = InmateProfile::where('firstname', $data['firstname'])
            ->where('lastname', $data['lastname'])
            ->where('middlename', $data['middlename'])
            ->where('birthdate', $data['birthdate'])
            ->exists();

        if ($exists) {
            throw ValidationException::withMessages([
                'data.firstname' => 'This inmate already exists.',
            ]);
        }
    }
}