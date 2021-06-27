<?php

namespace App\Http\Livewire\Question;

use App\Models\Category;
use App\Models\Question;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Create extends Component
{
    /**
     * @var string
     */
    public $questionId, $title, $category_id, $content, $level;


    /**
     * @return Application|Factory|View
     */
    public function render()
    {
        $category = Category::all();

        return view('livewire.question.create', compact('category'));
    }


    public function store()
    {
        $this->validate([
            'title'       => 'required',
            'category_id' => 'required',
            'content'     => 'required',
            'level'       => 'required',
        ]);

        $result = Question::create([
            'title'       => $this->title,
            'category_id' => $this->category_id,
            'content'     => $this->content,
            'level'       => $this->level,
        ]);

        if ($result)
        {
            $this->reset([
                'title',
                'category_id',
                'content',
                'level'
            ]);
            $this->emit('closeCreateModalSuccess');
        } else
        {
            $this->emit('closeCreateModalFailed');
        }

        $this->emit('renderOnly');
    }
}
