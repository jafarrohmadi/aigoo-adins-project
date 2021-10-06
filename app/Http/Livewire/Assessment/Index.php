<?php

namespace App\Http\Livewire\Assessment;


use App\Exports\AssessmentExport;
use App\Models\Assessment;

use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class Index extends
    Component
{
    use WithPagination;

    public int $paginate = 10;
    public $assessor_id, $user_id, $question_id, $search, $value, $assessmentData, $date, $userData, $totalData, $endDate;
    public $assessmentExcel;


    protected array $updatesQueryString = ['search'];

    protected $listeners
        = [
            'renderOnly' => '$refresh',
            'delete'     => 'delete',
            'updateUser',
        ];

    public function mount()
    {
        $this->search = request()->query('search', $this->search);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingPaginate()
    {
        $this->resetPage();
    }

    public function render()
    {
        $assessmentData = $this->assessmentData ?? '';

        if ($this->search) {
            $query = Assessment::latest()->whereHas('assessor', function ($q) {
                $q->where('name', 'like', '%'.$this->search.'%');
            })->select('assessor_id', 'user_id', 'created_at', 'assessment_year_month', 'created_at')
                ->where('assessment_info',
                null)->with('assessor', 'user')->groupBy('user_id', 'assessor_id');

            if ($this->userData != null) {
                $query = $query->where('user_id', $this->userData);
            }

            if ($this->date != null) {
                $query = $query->where('created_at','>=', date('Y-m-d', strtotime($this->date)));
            }

            if ($this->endDate != null) {
                $query = $query->where('created_at','<=', date('Y-m-d', strtotime($this->endDate)));
            }

            $this->totalData = $query->count();

            return view('livewire.assessment.index', [
                'assessment'     => $query->paginate($this->paginate),
                'assessmentData' => $assessmentData,
                'date'           => $this->date,
                'userData'       => $this->userData,
            ]);
        } else {
            $query = Assessment::where('assessment_info', null)->with('assessor', 'user', 'question')->groupBy('user_id', 'assessor_id');

            if ($this->userData != null) {
                $query = $query->where('user_id', $this->userData);
            }

            if ($this->date != null) {
                $query = $query->where('created_at','>=', date('Y-m-d', strtotime($this->date)));
            }

            if ($this->endDate != null) {
                $query = $query->where('created_at','<=', date('Y-m-d', strtotime($this->endDate)));
            }

            $this->totalData = $query->count();

            if($this->totalData > 0) {
                $this->emit('updateUserData', $query->get());
                $this->assessmentExcel = $query->get();
            }else{
                $this->emit('updateUserData' , null);
            }

            return view('livewire.assessment.index', [
                'assessment'     => $query->paginate($this->paginate),
                'assessmentData' => $assessmentData,
                'date'           => $this->date,
                'userData'       => $this->userData,

            ]);
        }
    }

    public function getAssessment(
        $assessor_id, $user_id, $assessment_year_month
    ) {
        $assessment = Assessment::where([
            'assessor_id'           => $assessor_id,
            'user_id'               => $user_id,
            'assessment_year_month' => $assessment_year_month,
        ])->where('assessment_info', null)->with('question')->get();

        $this->assessmentData = $assessment;
    }

    public function updateUser($date, $userId , $endDate) {
        $this->userData = $userId;
        $this->date     = $date;
        $this->endDate  = $endDate;
    }

    public function downloadExcel()
    {
        return Excel::download(new AssessmentExport($this->assessmentExcel), 'assessment-'.date('Y-m-d-'.$this->userData . '-'. $this->date).'.xlsx');
    }

}
