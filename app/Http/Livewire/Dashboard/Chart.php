<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\PointHistory;
use Carbon\Carbon;
use Livewire\Component;

class Chart extends Component
{
    public $divisions;
    public $divisionAggregate;
    public $daily;

    protected $listeners = ['changeFilter' => 'filter'];

    public function filter($filtering)
    {
        $points = PointHistory::with('user')->get();
        $this->calculateDivisionChart($points);
        $this->calculateDailyChart($points);
    }

    public function calculateDivisionChart($points)
    {
        $divisionPoints = collect($points)->groupBy('user.department_name')->map(function($item){
            return $item->sum('coins');
        })->sortDesc();

        $this->divisions = $divisionPoints->keys()->all();

        $this->divisionAggregate = $divisionPoints->values()->all();
    }

    public function calculateDailyChart($points)
    {
        $dailyPoints = collect($points)->groupBy(function($date){
            return Carbon::parse($date->created_at)->format('Y-m-d');
        })->map(function($item) {
            return $item->sum('coins');
        })->toArray();
        ksort($dailyPoints);

        $data = [];
        foreach($dailyPoints as $key => $point):
            $val = ['date' => $key, 'value' => $point];
            array_push($data, $val);
        endforeach;

        $this->daily = $data;
    }

    public function render()
    {
        return view('livewire.dashboard.chart');
    }
}
