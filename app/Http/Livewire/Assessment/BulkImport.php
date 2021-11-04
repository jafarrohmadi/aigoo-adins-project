<?php

namespace App\Http\Livewire\Assessment;

use App\Exports\AssessmentExport;
use App\Models\Department;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class BulkImport extends Component
{
    use WithPagination;

    public int $paginate = 10;
    public $selectDate, $selectName , $endDate, $selectDepartment;


    protected $listeners
        = [
            'renderOnly' => '$refresh',
        ];

    public function render()
    {
        $user = Cache::remember('user123', '300', function () {
            return User::wherehas('assessment', function ($query)
            {
                $query->where('assessment_info', null);
            })->get();
        });

        $department = Cache::remember('department123', '300', function () {
            return Department::all();
        });



        return view('livewire.assessment.filter-bulk-import', [
            'user' => $user,
            'department' => $department
        ]);

    }

    public function downloadExcel()
    {
        dd($this);
        return Excel::download(new AssessmentExport(), 'assessment-'.date('Y-m-d-'.$this->userData . '-'. date('Y-m-d')).'.xlsx');
    }

}
