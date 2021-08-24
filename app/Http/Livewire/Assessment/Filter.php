<?php

namespace App\Http\Livewire\Assessment;

use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;
use Livewire\WithPagination;

class Filter extends
    Component
{
    use WithPagination;

    public int $paginate = 10;
    public $selectDate, $selectName;


    protected $listeners
        = [
            'renderOnly' => '$refresh',
        ];

    public function render()
    {
        $user = Cache::remember('user', '300', function () {
            return User::has('assessment')->get();
        });

        return view('livewire.assessment.filter', [
            'user' => $user,
        ]);

    }

    public function updateAssessmentData()
    {
        $this->emit('updateUser', $this->selectDate, $this->selectName);
    }

}
