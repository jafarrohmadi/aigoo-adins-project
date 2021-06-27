<?php

namespace App\Http\Livewire\Category;

use App\Models\Category;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Create extends Component
{
    /**
     * @var string
     */
    public $name;

    /**
     * @return Application|Factory|View
     */
    public function render()
    {
        return view('livewire.category.create');
    }


    public function store()
    {
        $this->validate([
            'name'   => 'required',
        ]);

        $result = Category::create([
            'name' => $this->name,
        ]);

        if ($result)
        {
            $this->reset([
                'name',
            ]);
            $this->emit('closeCreateModalSuccess');
        } else
        {
            $this->emit('closeCreateModalFailed');
        }

        $this->emit('renderOnly');
    }
}
