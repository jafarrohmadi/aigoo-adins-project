<?php

namespace App\Exports;

use App\Models\Assessment;
use App\Models\Question;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AssessmentExport implements
    FromView,
    ShouldAutoSize
{
    protected $number, $collectionData;

    public function __construct($collection)
    {
        $this->collectionData = $collection;
        $this->number     = 1;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return $this->collectionData;
    }

    public function headings(): array
    {
        $data[] = 'No';
        $data[] = 'Assessment';

        foreach ($this->collectionData as $dataUser){
            $data[] = $dataUser->assessor->name;
        }

        return $data;
    }

    public function map($row): array
    {
//        $data = Assessment::where([
//            'assessor_id'           => $row->assessor_id,
//            'user_id'               => $row->user_id,
//            'assessment_year_month' => $row->assessment_year_month,
//        ])->where('assessment_info', null)->with('question')->get();
//        $mapData = [];
//        foreach ($data as $key => $datum)
//        {
//            $mapData[$key][] = $this->number++;
//            $mapData[$key][] = $datum->question->content;
//            $mapData[$key][] = $datum->value;
//        }
//        $assessorRole = '';
//        if ($row->user->id == $row->assessor->id) {
//            $assessorRole = 'Diri Sendiri';
//        } else {
//            if ($row->assessor->id == $row->user->supervisor_id) {
//                $assessorRole = 'Atasan';
//            }
//
//            if ($row->assessor->supervisor_id == $row->user->id) {
//                $assessorRole = 'Bawahan';
//            }
//
//            if ($row->user->department == $row->assessor->department) {
//                $assessorRole = 'Satu Tim';
//            }
//
//            if ($row->user->department != $row->assessor->department) {
//                $assessorRole = 'Beda Tim';
//            }
//        }


//        return [
//            $this->number++,
//            $row->assessor ? ($row->assessor->name.' ('.$row->assessor->department.')') : '',
//            $assessorRole,
//            $row->user ? ($row->user->name. ' ('. $row->user->department .')') : '',
//            date('d F Y', strtotime($row->created_at))
//        ];

      //  return $mapData;
    }

    public function view(): View
    {
        $assessmentQuestion = Question::all();

        $assessmentMonth = $this->collectionData->sortByDesc('assessment_year_month')->groupBy('assessment_year_month');

        return view('assessment.exports', [
            'data' => $this->collectionData,
            'assessment' => $assessmentQuestion,
            'assessmentMonth' => $assessmentMonth
        ]);
    }
}
