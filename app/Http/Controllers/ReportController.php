<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jailbook;

class ReportController extends Controller
{
    public function generate($id)
    {
        $jailbook = Jailbook::with([
            'inmate.religion',
            'inmate.ethnicity',
            'offense',
            'court',
            'judge',
            'station',
            'identifiedMarks',
            'fingerprint.specimens',
        ])->findOrFail($id);

      
        $marks = $jailbook->identifiedMarks->map(function ($mark) {

            $details = json_decode($mark->mark_details, true);

            $cleanDetails = collect($details)->map(function ($d) {
                return [
                    'side' => $d['side'] ?? null,
                    'desc' => $d['desc'] ?? null,
                ];
            });

            return [
                'marked_image' => $mark->marked_image
                    ? url('storage/' . $mark->marked_image)
                    : null,
                'mark_details' => $cleanDetails,
            ];
        });

   
        $fingerprint = null;

        if ($jailbook->fingerprint) {
            $fingerprint = [
                'fingerprint_date' => $jailbook->fingerprint->fingerprint_date,
                'taken_by' => $jailbook->fingerprint->taken_by,
                'remarks' => $jailbook->fingerprint->remarks,
                'specimens' => $jailbook->fingerprint->specimens->map(function ($s) {
                    return [
                        'finger_name' => $s->finger_name,
                        'fingerprint_image' => $s->fingerprint_image
                            ? url('storage/' . $s->fingerprint_image)
                            : null,
                        'remarks' => $s->remarks,
                    ];
                }),
            ];
        }

        $data = [
            'case_no' => $jailbook->case_no,
            'address' => $jailbook->address,
            'civilStatus' => $jailbook->civilStatus,
            'height' => $jailbook->height,
            'weight' => $jailbook->weight,
            'hair' => $jailbook->hair,
            'alias' => $jailbook->alias,
            'complexion' => $jailbook->complexion,
            'occupation' => $jailbook->occupation,

            'date_received' => $jailbook->date_received,
            'detention_from' => $jailbook->detention_from,
            'detention_to' => $jailbook->detention_to,
            'status' => $jailbook->status,

                'firstname' => $jailbook->inmate->firstname,
                'middlename' => $jailbook->inmate->middlename,
                'lastname' => $jailbook->inmate->lastname,
                'birthdate' => $jailbook->inmate->birthdate,
                'sex' => $jailbook->inmate->sex,
                'place_of_birth' => $jailbook->inmate->place_of_birth,

                'religion' => $jailbook->inmate->religion->religion_name ?? null,
                'ethnicity' => $jailbook->inmate->ethnicity->ethnicity_name ?? null,

                'mother_name' => $jailbook->inmate->mother_name,
                'father_name' => $jailbook->inmate->father_name,
            
            'offense' => $jailbook->offense->offense_descr ?? null,

            
                'court_name' => $jailbook->court->court_name ?? null,
                'court_address' => $jailbook->court->court_address ?? null,
          

            'judge' => trim(
                ($jailbook->judge->firstname ?? '') . ' ' .
                ($jailbook->judge->middlename ?? '') . ' ' .
                ($jailbook->judge->lastname ?? '')
            ),

            'station' => $jailbook->station->station_name ?? null,

            'identified_marks' => $marks,

            'fingerprint' => $fingerprint,
        ];

        return response()->json([
             $data,
        ]);
    }
}