<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourtOrder extends Model
{
    protected $fillable = [
        'case_no',
        'order_category',
        'order_date',
        'receive_date',
        'receive_by',
        'approved_by',
        'approved_date',
        'order_no',
        'attachment',
    ];

    protected $casts = [
        'attachment' => 'array',
    ];

    public function jailbooks()
    {
        return $this->hasMany(Jailbook::class);
    }

    
}
