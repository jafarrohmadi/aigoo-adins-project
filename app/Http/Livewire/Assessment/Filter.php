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
    public $selectDate, $selectName , $endDate;


    protected $listeners
        = [
            'renderOnly' => '$refresh',
        ];

    public function render()
    {
        $user = Cache::remember('user123', '300', function () {
            return User::wherehas('assessment', function ($query)
            {
                $query->where('assessment_info', null);
            })->get();
        });

        return view('livewire.assessment.filter', [
            'user' => $user,
        ]);

    }

    public function updateAssessmentData()
    {
        if($this->selectName != '') {
            $this->emit('updateUser', $this->selectDate, $this->selectName, $this->endDate);
        }
    }

}
