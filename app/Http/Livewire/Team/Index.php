<?php

namespace App\Http\Livewire\Team;

use App\Models\Team;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    use WithFileUploads;

    /**
     * @var int
     */
    public int $paginate = 10;

    /**
     * @var string
     */
    public $search;

    /**
     * @var array|string[]
     */
    protected array $updatesQueryString = ['search'];

    protected $listeners
        = [
            'renderOnly'           => '$refresh',

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
            $query           = Team::latest()->where('name', 'like', '%' . $this->search . '%');
            $this->totalData = $query->count();
            return view('livewire.team.index', [
                'team' => $query->paginate($this->paginate)
            ]);
        } else
        {
            $query           = Team::latest();
            $this->totalData = $query->count();
            return view('livewire.team.index', [
                'team' => $query->paginate($this->paginate)
            ]);
        }
    }

}
