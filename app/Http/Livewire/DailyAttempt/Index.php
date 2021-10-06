<?php

namespace App\Http\Livewire\DailyAttempt;

use App\Models\DailyAttempt;
use Illuminate\Support\Facades\DB;
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
    public $search, $selectDate, $endDate;

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
        $query = DailyAttempt::select('date', 'user_id', 'quiz_ID',DB::raw('COUNT(attempt) as attempts'))->groupBy('date', 'user_id', 'quiz_ID');

        if ($this->search) {
            $query->whereHas('user', function ($query) {
                $query->where('name', 'like', '%'.$this->search.'%');
            });

        }

        if ($this->selectDate !== null) {
            $query = $query->where('created_at', '>=' , date('Y-m'. '-01', strtotime($this->selectDate)));
        }

        if ($this->endDate !== null) {
            $query = $query->where('created_at', '<=' , date('Y-m'. '-31', strtotime($this->endDate)));
        }

        $this->totalData = $query->count();
        return view('livewire.daily-attempt.index', [
            'daily' => $query->paginate($this->paginate),
        ]);
    }
}
