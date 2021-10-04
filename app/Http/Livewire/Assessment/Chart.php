<?php

namespace App\Http\Livewire\Assessment;


use App\Models\Assessment;

use App\Models\AssessmentCategory;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;
use Livewire\WithPagination;
use function Clue\StreamFilter\fun;

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
            'assessment'  => $this->assessment,
            'name'        => $this->name,
            'label'       => $this->label,
            'datas'       => $this->datas,
            'supervisor'  => $this->supervisor,
            'subordinate' => $this->subordinate,
            'otherteam'   => $this->otherteam,
        ]);
    }

    public function updateUserData($assessment)
    {
        $this->assessment = '';
        if ($assessment) {
            $this->assessment = $assessment;
            $this->name       = $assessment[0]['user']['name'];

            $datum = collect($this->assessment)->groupBy('question.category')->map(function ($item) {
                return $item->avg('value');
            })->sortDesc();

            $this->label = collect($datum->keys()->all())->map(function ($item){
                return AssessmentCategory::find($item)->name;
            });

            $this->datas = $datum->values()->all();
            $this->dispatchBrowserEvent('updateChart');

            $getSupervisor  = User::where('id', $assessment[0]['user_id'])->first();
            $getSubordinate = User::where('supervisor_id', $assessment[0]['user_id'])->get();

            $getSupervisorSubordinateId = $getSubordinate->pluck('id')->toArray();
            array_push($getSupervisorSubordinateId, $getSupervisor->id);

            $subordinate = [];
            $supervisor  = [];
            $otherteam   = [];
            if ($getSupervisor || $getSubordinate) {
                $countSupervisor = $valueSupervisor = 0;

                foreach ($assessment as $assess) {
                    if ($getSupervisor->supervisor_id == $assess['assessor_id']) {
                        $valueSupervisor = $valueSupervisor + $assess['value'];
                        $countSupervisor++;
                    }

                    $valueSubordinate = 0;
                    foreach ($getSubordinate as $subOrdinateData) {
                        if ($subOrdinateData->id == $assess['assessor_id']) {
                            $valueSubordinate = $assess['value'];
                        }
                    }

                    if ($valueSubordinate > 0) {
                        $subordinate[$assess['assessor']['name']][] = $valueSubordinate;
                    }

                    if (!in_array($assess['assessor_id'], $getSupervisorSubordinateId)) {
                        $otherteam[$assess['assessor']['name']][] = $assess['value'];
                    }

                }

                if ($countSupervisor > 0) {
                    $supervisor = [$getSupervisor->supervisor->name => ($valueSupervisor / $countSupervisor)];
                }
            }

            $this->supervisor  = $supervisor;
            $this->subordinate = $subordinate;
            $this->otherteam   = $otherteam;
        }
    }
}
