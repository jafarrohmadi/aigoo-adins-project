<?php

namespace App\Http\Livewire\DailyAttempt;

use App\Models\DailyAttempt;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Index extends
    Component
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
            'renderOnly' => '$refresh',

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
        if ($this->search) {
            $query           = DailyAttempt::latest()->where('name', 'like', '%'.$this->search.'%');
            $this->totalData = $query->count();
            return view('livewire.daily-attempt.index', [
                'daily'     => $query->paginate($this->paginate),
            ]);
        } else {
            $query           = DailyAttempt::latest();
            $this->totalData = $query->count();
            return view('livewire.daily-attempt.index', [
                'daily'     => $query->paginate($this->paginate),
            ]);
        }
    }
}
