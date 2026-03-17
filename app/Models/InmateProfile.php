<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InmateProfile extends Model
{
    protected $fillable = [
        'pdl_number',
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
        'province_id',
        'municipality_id',
        'barangay_id',
        'mother_name',
        'father_name',
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
}