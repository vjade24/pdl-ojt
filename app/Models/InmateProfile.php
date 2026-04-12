<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InmateProfile extends Model
{
    protected $fillable = [
        'firstname',
        'middlename',
        'lastname',
        'suffix',
        'birthdate',
        'sex',
        'civil_status',
        'height',
        'weight',
        'complexion',
        'religion_id',
        'ethnicity_id',
        'place_of_birth',
        'mother_name',
        'father_name',
        'skills',
        'married_lastname',
        'inmate_id',
    ];

    public function religion()
    {
        return $this->belongsTo(Religion::class);
    }

    public function ethnicity()
    {
        return $this->belongsTo(Ethnicity::class);
    }

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function municipality()
    {
        return $this->belongsTo(Municipality::class);
    }

    public function barangay()
    {
        return $this->belongsTo(Barangay::class);
    }

    public function getFullNameAttribute()
    {
        return trim("{$this->firstname} {$this->middlename} {$this->lastname} {$this->suffix}");
    }

    public function jailbook()
    {
    return $this->hasOne(\App\Models\Jailbook::class, 'inmate_profile_id', 'id');
    }

    public function jailbooks()
    {
    return $this->hasMany(Jailbook::class);
    }
    public function fingerprints()
    {
    return $this->hasMany(Fingerprint::class);
    }

public function fingerprint()
{
    return $this->hasOne(\App\Models\Fingerprint::class, 'inmate_profile_id', 'id');
}
}   