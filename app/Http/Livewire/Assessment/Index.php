<?php

namespace App\Http\Livewire\Assessment;


use App\Models\Assessment;

use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends
    Component
{
    use WithPagination;

    public int $paginate = 10;
    public $assessor_id, $user_id, $question_id, $search, $value, $assessmentData, $date, $userData;


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
            })->select('assessor_id', 'user_id', 'created_at', 'assessment_year_month')->where('assessment_info',
                null)->groupBy('assessor_id',
                'user_id', 'assessment_year_month')->with('assessor',
                'user');

            if ($this->userData != null) {

                $query = $query->where('user_id', $this->userData);
            }

            if ($this->date != null) {
                $query = $query->where('assessment_year_month', date('Y-m', strtotime($this->date)));
            }

            $this->totalData = $query->count();

            return view('livewire.assessment.index', [
                'assessment'     => $query->paginate($this->paginate),
                'assessmentData' => $assessmentData,
                'date'           => $this->date,
                'userData'       => $this->userData,
            ]);
        } else {
            $query = Assessment::select('assessor_id', 'user_id', 'question_id',
                'created_at', 'assessment_year_month', 'value')->where('assessment_info', null)->with('assessor', 'user', 'question');

            if ($this->userData != null) {
                $query = $query->where('user_id', $this->userData);
            }

            if ($this->date != null) {
                $query = $query->where('assessment_year_month', date('Y-m', strtotime($this->date)));
            }

            $this->totalData = $query->count();

            $this->emit('updateUserData',  $query->get());

            $query = $query->groupBy('assessor_id',
                'user_id',
                'assessment_year_month');

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

    public function updateUser($date, $userId) {
        $this->userData = $userId;
        $this->date     = $date;
    }

}
