<?php

namespace App\Http\Livewire\Setting;

use App\Models\Setting;
use Livewire\Component;

class Index extends Component
{
    public $nameGameSetting;
    public $valueGameSetting;

    public $titleLevel1;
    public $titleLevel2;
    public $titleLevel3;
    public $titleLevel4;
    public $titleLevel5;
    public $titleLevel6;
    public $titleLevel7;
    public $titleLevel8;
    public $titleLevel9;
    public $titleLevel10;

    public $nameTitle1;
    public $nameTitle2;
    public $nameTitle3;
    public $nameTitle4;
    public $nameTitle5;
    public $nameTitle6;
    public $nameTitle7;
    public $nameTitle8;
    public $nameTitle9;
    public $nameTitle10;

    public function mount()
    {
        $settingsGame           = Setting::where('group_name', 'game_settings')->get();
        $this->nameGameSetting  = $settingsGame[0]->name;
        $this->valueGameSetting = $settingsGame[0]->value;

        $titleLevel = Setting::where('group_name', 'title_level')->get();

        for ($j = 1; $j < 11; $j++)
        {
            $this->{'nameTitle'. $j} = $titleLevel[$j -1]->name;
            $this->{'titleLevel'. $j} = $titleLevel[$j -1]->value;
        }

    }

    public function render()
    {
        return view('livewire.setting.index');
    }

    public function updateGameSettings()
    {
        if ($this->valueGameSetting)
        {

            $this->validate([
                'valueGameSetting' => 'required|numeric'
            ]);

            Setting::where('group_name', 'game_settings')->update(['value' => $this->valueGameSetting]);
        }

        $this->emit('closeEditModalSuccess');

    }

    public function updateTitleLevel()
    {
        $this->validate([
            'titleLevel1'  => 'required|numeric',
            'titleLevel2'  => 'required|numeric',
            'titleLevel3'  => 'required|numeric',
            'titleLevel4'  => 'required|numeric',
            'titleLevel5'  => 'required|numeric',
            'titleLevel6'  => 'required|numeric',
            'titleLevel7'  => 'required|numeric',
            'titleLevel8'  => 'required|numeric',
            'titleLevel9'  => 'required|numeric',
            'titleLevel10' => 'required|numeric',

        ]);

        for ($i = 1; $i < 11; $i++)
        {
            Setting::where('name', $this->{'nameTitle' . $i})->update(['value' => $this->{'titleLevel' . $i}]);
        }

        $this->emit('closeEditModalSuccess');

    }
}
