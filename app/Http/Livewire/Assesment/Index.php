<?php

namespace App\Http\Livewire\Assessment;


use App\Models\Assessment;
use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public int $paginate = 10;
    public $assessor_id, $user_id, $question_id, $search , $value;

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
            $query           = Assessment::latest()->where('user_id', 'like', '%' . $this->search . '%');
            $this->totalData = $query->count();
            return view('livewire.assessment.index', [
                'assessment' => $query->paginate($this->paginate)
            ]);
        } else
        {
            $query           = Assessment::latest();
            $this->totalData = $query->count();
            return view('livewire.assessment.index', [
                'assessment' => $query->paginate($this->paginate)
            ]);
        }
    }
}
