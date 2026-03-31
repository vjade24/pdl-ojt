<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fingerprint extends Model
{
    protected $fillable = [
        'jailbook_id',
        'fingerprint_date',
        'taken_by',
        'remarks',
    ];

    public function inmate()
    {
        return $this->belongsTo(InmateProfile::class, 'inmate_profile_id');
    }

    public function specimens()
    {
    return $this->hasMany(\App\Models\Specimen::class);
    }
    public function jailbook()
    {
    return $this->belongsTo(Jailbook::class);
    }


}