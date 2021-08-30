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
    public $data, $assessment, $label, $datas, $name, $supervisor, $subordinate, $otherteam;

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
        if ($assessment) {
            $this->assessment = $assessment;
            $this->name       = $assessment[0]['user']['name'];
            $datum            = collect($this->assessment)->groupBy('question.category')->map(function ($item) {
                return $item->avg('value');
            })->sortDesc();

            $this->label = $datum->keys()->all();

            $this->datas = $datum->values()->all();
            $this->dispatchBrowserEvent('updateChart');
            $getSupervisor  = User::where('id', $assessment[0]['user_id'])->first();
            $getSubordinate = User::where('supervisor_id', $assessment[0]['user_id'])->get();

            $subordinate = [];
            $supervisor      = [];
            if ($getSupervisor || $getSubordinate) {
                $countSupervisor = $valueSupervisor = 0;

                foreach ($assessment as $assess) {
                    if ($getSupervisor->supervisor_id == $assess['assessor_id']) {
                        $valueSupervisor = $valueSupervisor + $assess['value'];
                        $countSupervisor++;
                    }

                    $countSubordinate = $valueSubordinate = 0;
                    foreach ($getSubordinate as $subOrdinateData) {
                        if ($subOrdinateData->id == $assess['assessor_id']) {
                            $valueSubordinate = $valueSubordinate + $assess['value'];
                            $countSubordinate++;
                        }
                    }
                    
                    if ($countSubordinate > 0) {
                        $subordinate[$assess['assessor']['name']][] =  ($valueSubordinate / $countSubordinate);
                    }
                }

                if ($countSupervisor > 0) {
                    $supervisor = [$getSupervisor->supervisor->name => ($valueSupervisor / $countSupervisor)];
                }
            }

            $this->supervisor = $supervisor;
            $this->subordinate = $subordinate;

        }
    }
}
