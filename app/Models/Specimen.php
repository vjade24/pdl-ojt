<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Specimen extends Model
{
    protected $fillable = [
        'fingerprint_id',
        'finger_name',
        'fingerprint_image',
    ];

    public function fingerprint()
    {
        return $this->belongsTo(Fingerprint::class);
    }
}