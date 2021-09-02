<?php

namespace App\Http\Livewire\Leaderboard;

use App\Models\Department;
use App\Models\User;
use App\ViewModels\VwLeadeboard;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends
    Component
{
    use WithPagination;

    public $paginate = 10;
    public $search, $filterByDepartment, $totalData, $department;
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
        if ($this->search !== null) {
            if ($this->filterByDepartment !== null) {
                $query           = VwLeadeboard::where('name', 'like', '%'.$this->search.'%')->where('department_id',
                    $this->filterByDepartment);
                $this->totalData = $query->count();
            } else {
                $query           = VwLeadeboard::where('name', 'like', '%'.$this->search.'%');
                $this->totalData = $query->count();
            }
        } else {
            if ($this->filterByDepartment !== null) {
                $query           = VwLeadeboard::where('department_id', $this->filterByDepartment);
                $this->totalData = $query->count();
            } else {
                $this->totalData = VwLeadeboard::count();

                return view('livewire.leaderboard.index', [
                    'department'   => $this->department,
                    'vwLeadeboard' => VwLeadeboard::with('department')->orderBy('total_points', 'desc')->paginate($this->paginate),
                ]);
            }
        }

        return view('livewire.leaderboard.index', [
            'department'   => $this->department,
            'vwLeadeboard' => $query->with('department')->orderBy('total_points', 'desc')->paginate($this->paginate),
        ]);
    }
}
