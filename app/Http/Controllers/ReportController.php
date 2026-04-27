<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jailbook;
use App\Models\InmateProfile;

class ReportController extends Controller
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
        return response()->json(['message' => 'Record not found'], 404);
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
                        ? url('storage/' . $s->fingerprint_image)
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
                ? url('storage/' . $mark->marked_image)
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
    $formattedMarks = $this->formatIdentifiedMarks($marksDetails);

                $data = [
                'id' => $jailbook->inmate->inmate_id,
                'fullname' => $jailbook->inmate->fullname,
                'sex' => $jailbook->inmate->sex,
                'age' => $jailbook->inmate->birthdate
                ? \Carbon\Carbon::parse($jailbook->inmate->birthdate)->age
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
                'civilStatus' => $jailbook->civilStatus,
                'father_name' => $jailbook->inmate->father_name,
                'mother_name' => $jailbook->inmate->mother_name,
                'address' => $jailbook->address, 
                'wife_husband' => $jailbook->wife_husb_name,
                'wife_add' => $jailbook ->wife_husb_add, 
                'educ_attainment' => $jailbook ->educ_attainment,
                'ethnicity' => $jailbook->inmate->ethnicity->ethnicity_name ?? null,
                'skills' =>    $jailbook->inmate->skills,
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
                'identified_marks' => $formattedMarks,
                'circumstances_arrest' => $jailbook->circum_arrest,
                'Confiscated' => $jailbook->confiscated,
                'Completion' => $jailbook->completion,
                'receiving_officer' => $jailbook->receiving_officer,
                'chief_admin' => $jailbook->chief_admin,
                'Provincial_Warden' => $jailbook->prov_warden,
                'identified_marks_images' => $this->formatIdentifiedMarksImages($marksWithImage),
                


            
                'fingerprint' => $fingerprint,
            ];

            return response()->json([
                $data,
            ]);
        }


    public function index()
    {
        $jailbooks = Jailbook::with([
            'inmate.religion',
            'inmate.ethnicity',
            'offense',
            'court',
            'judge',
            'station',
            'identifiedMarks',
            'fingerprint.specimens',
        ])->get();

        $result = $jailbooks->map(function ($jailbook) {

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

            $marksWithImage = $jailbook->identifiedMarks->map(function ($mark) {
                $details = json_decode($mark->mark_details, true);

                return [
                    'marked_image' => $mark->marked_image
                        ? url('storage/' . $mark->marked_image)
                        : null,
                    'mark_details' => collect($details)->map(function ($d) {
                        return [
                            'side' => $d['side'] ?? null,
                            'desc' => $d['desc'] ?? null,
                        ];
                    }),
                ];
            });

            $marksDetails = $marksWithImage->flatMap(function ($mark) {
                return $mark['mark_details'];
            });
            $formattedMarks = $this->formatIdentifiedMarks($marksDetails);

            return [
                'report_id' => $jailbook->id,
                'id' => $jailbook->inmate->inmate_id,
                'fullname' => $jailbook->inmate->fullname,
                'sex' => $jailbook->inmate->sex,
                'age' => $jailbook->inmate->birthdate
                    ? \Carbon\Carbon::parse($jailbook->inmate->birthdate)->age
                    : null,
                'offense' => $jailbook->offense->offense_descr ?? null,
                'identified_marks' => $formattedMarks,
                'fingerprint' => $fingerprint,
            ];
        });

        return response()->json($result);
    }

    public function inmate_report(Request $request)
    {
        $jailbooks = Jailbook::with([
                    'inmate.religion',
                    'inmate.ethnicity',
                    'offense',
                    'court',
                    'judge',
                    'station',
                    'identifiedMarks',
                    'fingerprint.specimens',
                ])
                    ->where('inmate_profile_id', $request->inmate_id)
                    ->when($request->filled('jailbooks_id'), function ($query) use ($request) {
                        $query->where('id', $request->jailbooks_id);
                    })
                    ->get();

        $result = $jailbooks->map(function ($jailbook) {

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

            $marksWithImage = $jailbook->identifiedMarks->map(function ($mark) {
                $details = json_decode($mark->mark_details, true);

                return [
                    'marked_image' => $mark->marked_image
                        ? url('storage/' . $mark->marked_image)
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

            return [
                'jailbooks_id' => $jailbook->id,
                'fullname' => $jailbook->inmate->fullname,
                'sex' => $jailbook->inmate->sex,
                'age' => $jailbook->inmate->birthdate
                    ? \Carbon\Carbon::parse($jailbook->inmate->birthdate)->age
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
                'civilStatus' => $jailbook->civilStatus,
                'father_name' => $jailbook->inmate->father_name,
                'mother_name' => $jailbook->inmate->mother_name,
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


                'circumstances_arrest' => $jailbook->circum_arrest,
                'Confiscated' => $jailbook->confiscated,
                'Completion' => $jailbook->completion,
                'receiving_officer' => $jailbook->receiving_officer,
                'chief_admin' => $jailbook->chief_admin,
                'Provincial_Warden' => $jailbook->prov_warden,
                'identified_marks_images' => $this->formatIdentifiedMarksImages($marksWithImage),
                'fingerprint' => $fingerprint,
            ];
        });

        return response()->json($result);
    }

    private function formatIdentifiedMarks($marksDetails): string
    {
        return collect($marksDetails)
            ->map(function ($mark) {
                $desc = trim((string) ($mark['desc'] ?? ''));
                $side = trim((string) ($mark['side'] ?? ''));

                if ($desc !== '' && $side !== '') {
                    return $desc . ' (' . $side . ')';
                }

                return $desc !== '' ? $desc : ($side !== '' ? '(' . $side . ')' : null);
            })
            ->filter()
            ->implode(', ');
    }

    private function formatIdentifiedMarksImages($marksWithImage)
    {
        return collect($marksWithImage)
            ->map(function ($mark) {
                $markDetails = collect($mark['mark_details'] ?? [])->values();

                return [
                    'marked_image' => $mark['marked_image'] ?? null,
                    'identified_marks' => $this->formatIdentifiedMarks($markDetails),
                ];
            })
            ->values();
    }
}