<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IdentifiedMark extends Model
{
    protected $fillable = [
        'jailbook_id',
        'marked_image',
        'mark_details',
    ];

    protected $casts = [
    'mark_details' => 'array',
    ];

    public function jailbook()
    {
        return $this->belongsTo(Jailbook::class);
    }
}
