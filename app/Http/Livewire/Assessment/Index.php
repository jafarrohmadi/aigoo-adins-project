<?php

namespace App\Http\Livewire\Assessment;


use App\Models\Assessment;

use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public int $paginate = 10;
    public $assessor_id, $user_id, $question_id, $search, $value;

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
        if ($this->search)
        {
            $query           = Assessment::latest()->whereHas('user', function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%');
            })->select('assessor_id', 'user_id', 'created_at')->groupBy('assessor_id', 'user_id')->with('assessor',
                'user', 'assessor.department', 'user.department');
            $this->totalData = $query->count();

            return view('livewire.assessment.index', [
                'assessment' => $query->paginate($this->paginate)
            ]);
        } else
        {
            $query           = Assessment::latest()->select('assessor_id', 'user_id',
                'created_at')->groupBy('assessor_id', 'user_id')->with('assessor', 'user', 'assessor.department',
                'user.department');
            $this->totalData = $query->count();
            return view('livewire.assessment.index', [
                'assessment' => $query->paginate($this->paginate)
            ]);
        }
    }
}
