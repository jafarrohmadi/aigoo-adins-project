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
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class AssessmentExport implements WithMultipleSheets
{
    protected $collectionData;

    public function __construct($collection)
    {
        $this->collectionData = $collection;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return $this->collectionData;
    }

    public function sheets(): array
    {
        $sheets = [];
        $assessmentMonth = $this->collectionData->sortByDesc('assessment_year_month')->groupBy('assessment_year_month');

        foreach ($assessmentMonth as $key => $month) {
            $sheets[] = new AssessmentPerMonthExport($month);
        }

        return $sheets;
    }
}
