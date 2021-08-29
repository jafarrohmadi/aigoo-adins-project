<?php

namespace App\Http\Livewire\Assessment;


use App\Models\Assessment;

use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;
use Livewire\WithPagination;

class Chart extends
    Component
{
    public $data, $assessment, $label, $datas, $name;

    protected $listeners
        = [
            'updateUserData',
        ];


    public function render()
    {
        return view('livewire.assessment.chart', [
            'assessment' => $this->assessment,
            'name'       => $this->name,
            'label'      => $this->label,
            'datas'      => $this->datas,
        ]);
    }

    public function updateUserData($assessment)
    {
        if($assessment) {
            $this->assessment = $assessment;
            $this->name       = $assessment[0]['user']['name'];
            $datum            = collect($this->assessment)->groupBy('question.category')->map(function ($item) {
                return $item->avg('value');
            })->sortDesc();

            $this->label = $datum->keys()->all();

            $this->datas = $datum->values()->all();
            $this->dispatchBrowserEvent('updateChart');
        }
    }

}
