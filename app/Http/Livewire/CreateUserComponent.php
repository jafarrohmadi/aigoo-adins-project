<?php

namespace App\Http\Livewire;

use App\Mail\InvitationMail;
use App\Models\Role;
use App\Models\User;
use App\Providers\AppServiceProvider;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use Livewire\Component;

class CreateUserComponent extends Component
{
    use HasLivewireAuth;

    /** @var \App\Models\User */
    public $user;

    public $roles;
    /**
     * Render the component view.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        $this->roles = collect([(object)['id' => 'Managerial', 'name' => 'Managerial'], (object)['id' => 'Staff', 'name' => 'Staff']]);

        return view('users.create')
            ->extends('layouts.app');
    }

    /**
     * Store new user.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $this->validate();

        $user = User::create([
            'email' => $this->user['email'],
            'roles' => $this->user['roles'],
            'name' => $this->user['name'],
            'employee_level_id' => $this->user['employee_level_id']

        ]);

        msg_success('User has been successfully created.');

 /*       Mail::to($user)
            ->queue(new InvitationMail($user, Carbon::tomorrow()));*/

        return redirect()->route('users.index');
    }

    /**
     * Validation rules.
     *
     * @return array
     */
    protected function rules()
    {
        return [
            'user.email' => [
                'required',
                'email',
                Rule::unique('users', 'email'),
            ],
            'user.roles' => [
                'required',
            ],
            'user.name' => [
                'required',
            ],
            'user.employee_level_id' => [
                'required'
            ]
        ];
    }
}
