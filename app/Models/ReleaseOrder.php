<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReleaseOrder extends Model
{
    protected $fillable = [
        'jailbook_id',
        'court_order_id',
        'judge_id',
        'release_date',
        'release_reason',
        'remarks',
        'received_by',
        'approved_by',
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

    public function judge()
    {
        return $this->belongsTo(Judge::class);
    }
}