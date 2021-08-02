<?php

namespace App\Http\Livewire\Department;

use App\Models\Category;
use App\Models\Department;
use App\Models\QuizChoice;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Index extends
    Component
{
    use WithPagination;
    use WithFileUploads;

    public $departmentId;
    public $team_leader;
    public $userDepartment;
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
        $userDepartment = $this->userDepartment ?? Department::first()->allUser;

        if ($this->search) {
            $query           = Department::latest()->where('name', 'like', '%'.$this->search.'%');
            $this->totalData = $query->count();
            return view('livewire.department.index', [
                'department'     => $query->paginate($this->paginate),
                'userDepartment' => $userDepartment,
            ]);
        } else {
            $query           = Department::latest();
            $this->totalData = $query->count();
            return view('livewire.department.index', [
                'department'     => $query->paginate($this->paginate),
                'userDepartment' => $userDepartment,
            ]);
        }
    }


    public function edit($id)
    {
        $team                 = Department::find($id);
        $this->team_leader    = $team->team_leader;
        $this->departmentId   = $team->id;
        $this->userDepartment = $team->allUser;
    }

    public function update()
    {
        if ($this->team_leader) {
            $department = Department::find($this->departmentId);

            $this->validate([
                'team_leader' => 'required',
            ]);


            $result = $department->update([
                'team_leader' => $this->team_leader,
            ]);
        }

        if ($result) {
            $this->reset([
                'team_leader',
                'departmentId',

            ]);
            $this->emit('closeEditModalSuccess');
        } else {
            $this->emit('closeEditModalFailed');
        }
    }

}
