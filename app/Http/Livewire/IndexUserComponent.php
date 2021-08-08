<?php

namespace App\Http\Livewire;

use App\Models\Department;
use App\Models\User;
use Livewire\Component;

class IndexUserComponent extends Component
{
    use HasTable, HasLivewireAuth;

    public $department_id, $userId;
    /** @var string */
    public $sortField = 'email';

    /** @var string */
    public $roleId = '';

    /** @var array */
    protected $queryString = [
        'perPage',
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
        $users = User::filter([
                'orderByField' => [$this->sortField, $this->sortDirection],
                'search' => $this->search,
                'roleId' => $this->roleId,
            ])->paginate($this->perPage);

        return view('users.index', ['users' => $users, 'department' => $department])
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
                'team_id' => $this->department_id
            ]);
        }

        if ($result) {
            $this->reset([
                'department_id',
                'userId',

            ]);
            $this->emit('closeEditModalSuccess');
        } else {
            $this->emit('closeEditModalFailed');
        }
    }
}
