<?php

namespace App\Http\Livewire\Assessment;


use App\Models\Assessment;

use Livewire\Component;
use Livewire\WithPagination;

class Index extends
    Component
{
    use WithPagination;

    public int $paginate = 10;
    public $assessor_id, $user_id, $question_id, $search, $value, $assessmentData;


    protected array $updatesQueryString = ['search'];

    protected $listeners
        = [
            'renderOnly' => '$refresh',
            'delete'     => 'delete',
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
            $query           = Assessment::latest()->whereHas('user', function ($q) {
                $q->where('name', 'like', '%'.$this->search.'%');
            })->select('assessor_id', 'user_id', 'created_at', 'assessment_year_month')->groupBy('assessor_id',
                'user_id', 'assessment_year_month')->with('assessor',
                'user');
            $this->totalData = $query->count();

            return view('livewire.assessment.index', [
                'assessment'     => $query->paginate($this->paginate),
                'assessmentData' => $assessmentData,
            ]);
        } else {
            $query           = Assessment::select('assessor_id', 'user_id',
                'created_at', 'assessment_year_month')->groupBy('assessor_id', 'user_id',
                'assessment_year_month')->with('assessor', 'user');
            $this->totalData = $query->count();

            return view('livewire.assessment.index', [
                'assessment'     => $query->paginate($this->paginate),
                'assessmentData' => $assessmentData,
            ]);
        }
    }

    public function getAssessment($assessor_id , $user_id , $assessment_year_month)
    {
        $assessment = Assessment::where([
            'assessor_id'           => $assessor_id,
            'user_id'               => $user_id,
            'assessment_year_month' => $assessment_year_month,
        ])->with('question')->get();

        $this->assessmentData = $assessment;
    }

}
