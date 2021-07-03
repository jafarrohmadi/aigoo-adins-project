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
    public $search, $filterByDepartment, $filterByGame, $totalData, $department;
    protected $updatesQueryString = ['search'];

    public function mount()
    {
        $this->search = request()->query('search', $this->search);
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
        if ($value === "")
        {
            $this->search = null;
        }
    }

    public function updatedFilterByDepartment($value)
    {
        $department = collect(User::select('department_id')->get())->pluck('department_id')->toArray();

        if ((!in_array($value, $department, true)))
        {
            $this->filterByDepartment = null;
        }
    }

    public function updatedFilterByGame($value)
    {
        if ((!in_array($value, ["1", "2", "3", "4"], true)))
        {
            $this->filterByGame = null;
        }
    }

    public function render()
    {
        if ($this->search !== null)
        {
            if ($this->filterByDepartment !== null and $this->filterByGame !== null)
            {
                $query           = VwLeadeboard::where('name', 'like',
                    '%' . $this->search . '%')->where('department_id', $this->filterByDepartment)->where('game_id',
                    $this->filterByGame);
                $this->totalData = $query->count();
            } elseif ($this->filterByDepartment !== null)
            {
                $query           = VwLeadeboard::where('name', 'like', '%' . $this->search . '%')->where('name',
                    $this->filterByDepartment);
                $this->totalData = $query->count();
            } elseif ($this->filterByGame !== null)
            {
                $query           = VwLeadeboard::where('name', 'like', '%' . $this->search . '%')->where('game_id',
                    $this->filterByGame);
                $this->totalData = $query->count();
            } else
            {
                $query           = VwLeadeboard::where('display_name', 'like', '%' . $this->search . '%');
                $this->totalData = $query->count();
            }
        } elseif ($this->filterByDepartment !== null)
        {
            if ($this->filterByGame !== null)
            {
                $query           = VwLeadeboard::where('division', $this->filterByDepartment)->where('game_id',
                    $this->filterByGame);
                $this->totalData = $query->count();
            } else
            {
                $query           = VwLeadeboard::where('division', $this->filterByDepartment);
                $this->totalData = $query->count();
            }
        } elseif ($this->filterByGame !== null)
        {
            if ($this->filterByDepartment !== null)
            {
                $query           = VwLeadeboard::where('game_id', $this->filterByGame)->where('division',
                    $this->filterByDepartment);
                $this->totalData = $query->count();

            } else
            {
                $query           = VwLeadeboard::where('game_id', $this->filterByGame);
                $this->totalData = $query->count();
            }
        } else
        {
            $this->totalData = VwLeadeboard::count();
            
            return view('livewire.leaderboard.index', [
                'department'   => $this->department,
                'vwLeadeboard' => VwLeadeboard::with('department')->paginate($this->paginate)
            ]);
        }
        
        return view('livewire.leaderboard.index', [
            'department'   => $this->department,
            'vwLeadeboard' => $query->with('department')->paginate($this->paginate)
        ]);
    }
}
