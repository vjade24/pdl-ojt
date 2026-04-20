<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Jailbook;

class PdfController extends Controller
{
    public function generate(Request $request)
    {
        $inmateId = $request->inmate_id;
        $reportId = $request->id;

        $jailbook = Jailbook::with([
            'inmate.religion',
            'inmate.ethnicity',
            'offense',
            'court',
            'judge',
            'station',
            'identifiedMarks',
            'fingerprint.specimens',
        ])
        ->where('id', $reportId)
        ->whereHas('inmate', function ($query) use ($inmateId) {
            $query->where('id', $inmateId);
        })
        ->first();

        if (!$jailbook) {
            abort(404, 'Record not found');
        }

       
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
                            ? public_path('storage/' . $s->fingerprint_image)
                            : null,
                        'remarks' => $s->remarks,
                    ];
                }),
            ];
        }

        
        $marksWithImage = $jailbook->identifiedMarks->map(function ($mark) {
            $details = json_decode($mark->mark_details, true);

            return [
                'marked_image' => $mark->marked_image
                    ? public_path('storage/' . $mark->marked_image)
                    : null,
                'mark_details' => collect($details)->map(function ($d) {
                    return [
                        'side' => $d['side'] ?? null,
                        'desc' => $d['desc'] ?? null,
                    ];
                }),
            ];
        });

        $marksDetails = $marksWithImage->flatMap(fn ($mark) => $mark['mark_details']);

      
        $data = [
            'id' => $jailbook->inmate->inmate_id,
            'name' => $jailbook->inmate->fullname,
            'sex' => $jailbook->inmate->sex,
            'age' => $jailbook->inmate->birthdate
                ? abs((int) now()->diffInYears($jailbook->inmate->birthdate))
                : null,
            'offense' => $jailbook->offense->offense_descr ?? null,
            'height' => $jailbook->height,
            'weight' => $jailbook->weight,
            'case_no' => $jailbook->case_no,
            'religion' => $jailbook->inmate->religion->religion_name ?? null,
            'hair' => $jailbook->hair,
            'alias' => $jailbook->alias,
            'complexion' => $jailbook->complexion,
            'birthdate' => $jailbook->inmate->birthdate,
            'place_of_birth' => $jailbook->inmate->place_of_birth,
            'occupation' => $jailbook->occupation,
            'civil_status' => $jailbook->inmate->civil_status ?? '',
            'father' => $jailbook->inmate->father_name ?? '',
            'mother' => $jailbook->inmate->mother_name ?? '',
            'address' => $jailbook->address,
            'wife_husband' => $jailbook->wife_husb_name,
            'wife_add' => $jailbook->wife_husb_add,
            'educ_attainment' => $jailbook->educ_attainment,
            'ethnicity' => $jailbook->inmate->ethnicity->ethnicity_name ?? null,
            'skills' => $jailbook->inmate->skills,
            'visited' => $jailbook->place_visited,
            'court_name' => $jailbook->court->court_name ?? null,
            'judge' => trim(
                ($jailbook->judge->firstname ?? '') . ' ' .
                ($jailbook->judge->middlename ?? '') . ' ' .
                ($jailbook->judge->lastname ?? '')
            ),
            'date_received' => $jailbook->date_received,
            'endorsing_officer' => $jailbook->endorsing_officer,
            'station' => $jailbook->station->station_name ?? null,
            'identified_marks' => $marksDetails,
            'identified_marks_images' => $marksWithImage->pluck('marked_image'),
            'circumstances' => $jailbook->circum_arrest,
            'Confiscated' => $jailbook->confiscated,
            'Completion' => $jailbook->completion,
            'receiving_officer' => $jailbook->receiving_officer,
            'chief_admin' => $jailbook->chief_admin,
            'Provincial_Warden' => $jailbook->prov_warden,
            'fingerprint' => $fingerprint,
        ];

   
        $pdf = Pdf::loadView('pdf.jail_booking_report', compact('data'));

        return $pdf->stream('jail_booking_report.pdf');
    }
}