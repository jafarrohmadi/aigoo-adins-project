<?php

namespace App\Http\Livewire\Leaderboard;

use App\Models\Department;
use App\Models\User;
use App\ViewModels\VwLeadeboard;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $paginate = 10;
    public $search, $filterByDepartment, $totalData, $department, $selectDate , $endDate;
    protected $updatesQueryString = ['search'];

    public function mount()
    {
        $this->search     = request()->query('search', $this->search);
        $this->department = Department::all()->pluck('name', 'id');
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingPaginate()
    {
        $this->resetPage();
    }

    public function updatedSearch($value)
    {
        if ($value === "") {
            $this->search = null;
        }
    }

    public function updatedFilterByDepartment($value)
    {
        $department = collect(Department::select('id')->get())->pluck('id')->toArray();

        if (!in_array($value, $department)) {
            $this->filterByDepartment = null;
        }
    }

    public function render()
    {
        $query = VwLeadeboard::with('department');
        if ($this->search !== null) {
            $query = $query->where('name', 'like', '%'.$this->search.'%');
        }

        if ($this->filterByDepartment !== null) {
            $query = $query->where('department_id', $this->filterByDepartment);
        }

        if ($this->selectDate !== null) {
            $query = $query->where('date', '>=' , date('Y-m', strtotime($this->selectDate)));
        }

        if ($this->endDate !== null) {
            $query = $query->where('date', '<=' , date('Y-m', strtotime($this->endDate)));
        }

        $this->totalData = $query->count();

        return view('livewire.leaderboard.index', [
            'department'   => $this->department,
            'vwLeadeboard' => $query->orderBy('total_points', 'desc')->paginate($this->paginate),
        ]);
    }
}
