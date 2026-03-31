<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IdentifiedMark extends Model
{
    protected $fillable = [
        'jailbook_id',
        'marks',
        'marked_image',
    ];

    public function jailbook()
    {
        return $this->belongsTo(Jailbook::class);
    }
}
