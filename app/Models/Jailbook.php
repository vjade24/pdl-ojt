<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jailbook extends Model
{
    protected $fillable = [
        'court_order_id',
        'inmate_profile_id',
        'add_province_name',
        'add_municipality_name',
        'add_barangay_name',
        'court_id',
        'judge_id',
        'station_id',
        'offense_id',
        'case_no',
        'address',
        'civilStatus',
        'height',
        'weight',
        'hair',
        'alias',
        'complexion',
        'occupation',
        'father_decease_tag',
        'mother_decease_tag',
        'wife_husb_name',
        'wife_husb_add',
        'educ_attainment',
        'place_visited',
        'date_received',
        'endorsing_officer',
        'circum_arrest',
        'confiscated',
        'completion',
        'receiving_officer',
        'chief_admin',
        'prov_warden',
        'detention_from',
        'detention_to',
        'status',
    ];

    public function inmate()
    {
        return $this->belongsTo(InmateProfile::class, 'inmate_profile_id');
    }

    public function court()
    {
        return $this->belongsTo(Court::class);
    }

    public function judge()
    {
        return $this->belongsTo(Judge::class);
    }

    public function station()
    {
        return $this->belongsTo(Station::class);
    }

    public function offense()
    {
        return $this->belongsTo(Offense::class);
    }

    public function courtOrder()
    {
    return $this->belongsTo(CourtOrder::class);
    }
    
    public function inmateProfile()
    {
    return $this->belongsTo(InmateProfile::class);
    }
    
}