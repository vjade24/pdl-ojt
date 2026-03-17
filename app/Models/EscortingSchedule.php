<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EscortingSchedule extends Model
{
    protected $fillable = [
        'jailbook_id',
        'court_order_id',
        'escort_date',
        'escort_time',
        'destination',
        'purpose',
        'escorting_officer',
        'remarks',
        'status',
    ];

    public function jailbook()
    {
        return $this->belongsTo(Jailbook::class);
    }

    public function courtOrder()
    {
        return $this->belongsTo(CourtOrder::class);
    }
}