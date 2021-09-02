<?php

namespace App\Http\Livewire;

use App\Models\Department;
use App\Models\User;
use Livewire\Component;

class IndexUserComponent extends Component
{
    use HasTable, HasLivewireAuth;

    public $paginate = 10;
    public $department_id, $userId, $supervisor_id;
    /** @var string */
    public $sortField = 'email';

    /** @var string */
    public $roleId = '';

    /** @var array */
    protected $queryString = [
        'sortField',
        'sortDirection',
        'search',
        'roleId',
    ];

    /** @var array */
    protected $listeners = ['entity-deleted' => 'render'];

    /**
     * Render the component view.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        $department = Department::all();
        $allUser = User::select('id', 'email', 'name', 'department')->orderBy('department', 'ASC')
            ->orderBy('name','ASC')->get();

        $users = User::filter([
                'orderByField' => [$this->sortField, $this->sortDirection],
                'search' => $this->search,
                'roleId' => $this->roleId,
            ])->paginate($this->paginate);

        return view('users.index', ['users' => $users, 'department' => $department, 'allUser' => $allUser])
            ->extends('layouts.app');
    }

    /**
     * Reset pagination back to page one if search query is changed.
     *
     * @return void
     */
    public function updatedSearch()
    {
        $this->resetPage();
    }


    public function updatingPaginate()
    {
        $this->resetPage();
    }

    /**
     * Reset pagination back to page one if roleId query is changed.
     *
     * @return void
     */
    public function updatedRoleId()
    {
        $this->resetPage();
    }

    public function edit($id)
    {
        $user                 = User::find($id);
        $this->department_id   = $user->department_id;
        $this->userId = $user->id;
        $this->supervisor_id = $user->supervisor_id;
    }

    public function update()
    {
        if ($this->userId) {
            $user = User::find($this->userId);

            $this->validate([
                'department_id' => 'required',
            ]);


            $result = $user->update([
                'department_id' => $this->department_id,
                'team_id' => $this->department_id,
                'supervisor_id' => $this->supervisor_id
            ]);
        }

        if ($result) {
            $this->reset([
                'department_id',
                'userId',
                'supervisor_id'

            ]);
            $this->emit('closeEditModalSuccess');
        } else {
            $this->emit('closeEditModalFailed');
        }
    }
}
