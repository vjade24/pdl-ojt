<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Judge extends Model
{
    protected $fillable = [
        'firstname',
        'middlename',
        'lastname',
        'suffix',
    ];
}
