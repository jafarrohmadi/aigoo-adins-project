<?php

namespace App\Http\Livewire\ActivityLogs;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Spatie\Activitylog\Models\Activity;

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
            $query           = Activity::latest()->whereHas('causer', function ($q) {
                $q->where('name', 'like', '%'.$this->search.'%');
            })->orWhere('description', 'like', '%'.$this->search.'%');

            $this->totalData = $query->count();
            return view('livewire.activity-log.index', [
                'activityLogs' => $query->paginate($this->paginate),
            ]);
        } else {
            $query           = Activity::latest();
            $this->totalData = $query->count();
            return view('livewire.activity-log.index', [
                'activityLogs' => $query->paginate($this->paginate),
            ]);
        }
    }

}
