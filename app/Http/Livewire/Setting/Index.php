<?php

namespace App\Http\Livewire\Setting;

use App\Models\Setting;
use Livewire\Component;

class Index extends Component
{
    public $name1;
    public $name2;
    public $name3;
    public $name4;
    public $name5;
    public $name6;
    public $name7;
    public $name8;
    public $name9;
    public $name10;
    public $name11;
    public $name12;
    public $name13;
    public $name14;
    public $name15;
    public $name16;
    public $name17;
    public $name18;
    public $name19;
    public $name20;
    public $name21;
    public $name22;
    public $name23;
    public $name24;
    public $name25;
    public $name26;
    public $name27;
    public $name28;
    public $name29;
    public $name30;
    public $name31;
    public $name32;
    public $name33;
    public $name34;
    public $name35;
    public $name36;
    public $name37;
    public $name38;
    public $name39;
    public $name40;
    public $expTable1;
    public $expTable2;
    public $expTable3;
    public $expTable4;
    public $expTable5;
    public $expTable6;
    public $expTable7;
    public $expTable8;
    public $expTable9;
    public $expTable10;
    public $expTable11;
    public $expTable12;
    public $expTable13;
    public $expTable14;
    public $expTable15;
    public $expTable16;
    public $expTable17;
    public $expTable18;
    public $expTable19;
    public $expTable20;
    public $expTable21;
    public $expTable22;
    public $expTable23;
    public $expTable24;
    public $expTable25;
    public $expTable26;
    public $expTable27;
    public $expTable28;
    public $expTable29;
    public $expTable30;
    public $expTable31;
    public $expTable32;
    public $expTable33;
    public $expTable34;
    public $expTable35;
    public $expTable36;
    public $expTable37;
    public $expTable38;
    public $expTable39;
    public $expTable40;
    public $nameGameSetting;
    public $valueGameSetting;

    public function mount()
    {
        $settingsExp = Setting::where('group_name', 'exp_table')->orderBy('id', 'asc')->get();
        for ($i = 1; $i < 41; $i++)
        {
            $this->{'name' . $i}     = $settingsExp[$i - 1]->name;
            $this->{'expTable' . $i} = $settingsExp[$i - 1]->value;
        }

        $settingsGame           = Setting::where('group_name', 'game_settings')->get();
        $this->nameGameSetting  = $settingsGame[0]->name;
        $this->valueGameSetting = $settingsGame[0]->value;
    }

    public function render()
    {
        return view('livewire.setting.index');
    }

    public function updateExpTable()
    {
        $this->validate([
            'expTable1'  => 'required|numeric',
            'expTable2'  => 'required|numeric',
            'expTable3'  => 'required|numeric',
            'expTable4'  => 'required|numeric',
            'expTable5'  => 'required|numeric',
            'expTable6'  => 'required|numeric',
            'expTable7'  => 'required|numeric',
            'expTable8'  => 'required|numeric',
            'expTable9'  => 'required|numeric',
            'expTable10' => 'required|numeric',
            'expTable11' => 'required|numeric',
            'expTable12' => 'required|numeric',
            'expTable13' => 'required|numeric',
            'expTable14' => 'required|numeric',
            'expTable15' => 'required|numeric',
            'expTable16' => 'required|numeric',
            'expTable17' => 'required|numeric',
            'expTable18' => 'required|numeric',
            'expTable19' => 'required|numeric',
            'expTable20' => 'required|numeric',
            'expTable21' => 'required|numeric',
            'expTable22' => 'required|numeric',
            'expTable23' => 'required|numeric',
            'expTable24' => 'required|numeric',
            'expTable25' => 'required|numeric',
            'expTable26' => 'required|numeric',
            'expTable27' => 'required|numeric',
            'expTable28' => 'required|numeric',
            'expTable29' => 'required|numeric',
            'expTable30' => 'required|numeric',
            'expTable31' => 'required|numeric',
            'expTable32' => 'required|numeric',
            'expTable33' => 'required|numeric',
            'expTable34' => 'required|numeric',
            'expTable35' => 'required|numeric',
            'expTable36' => 'required|numeric',
            'expTable37' => 'required|numeric',
            'expTable38' => 'required|numeric',
            'expTable39' => 'required|numeric',
            'expTable40' => 'required|numeric'
        ]);

        for ($i = 1; $i < 41; $i++)
        {
            Setting::where('name', (string)$i)->update(['value' => $this->{'expTable' . $i}]);
        }

        $this->emit('closeEditModalSuccess');

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
}
