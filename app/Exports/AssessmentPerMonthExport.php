<?php

namespace App\Exports;

use App\Models\Question;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithTitle;

class AssessmentPerMonthExport implements  FromView, ShouldAutoSize, WithTitle
{
    public $assessmentMonth;

    public function __construct($assessmentMonth)
    {
        $this->assessmentMonth     = $assessmentMonth;
    }

     public function headings(): array
     {
         $data[] = 'No';
         $data[] = 'Assessment';

         foreach ($this->assessmentMonth as $dataUser){
             $data[] = $dataUser->assessor->name;
         }

         return $data;
     }

      public function view(): View
      {
          $assessmentQuestion = Question::orderBy('category')->get();

          return view('assessment.exports', [
              'assessment' => $assessmentQuestion,
              'assessmentMonts' => $this->assessmentMonth
          ]);
      }
    /**
     * @return string
     */
    public function title(): string
    {
        return 'Month ' . $this->assessmentMonth->first()->assessment_year_month;
    }
}