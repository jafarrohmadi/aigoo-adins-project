<?php

namespace App\Http\Livewire\QuizGame\Choices;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\QuizChoice;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public $question, $choice1, $choice2, $choice3, $choice4, $choice5, $answer,  $category, $level, $categoryList;


    public function render()
    {
        $this->categoryList = Category::orderby('name', 'asc')->get();
        return view('livewire.quiz-game.choices.create');
    }

    public function store()
    {
        $this->validate([
            'question'   => 'required',
            'choice1'    => 'required',
            'choice2'    => 'required',
            'choice3'    => 'required',
            'choice4'    => 'required',
            'choice5'    => 'required',
            'answer'     => 'required|digits_between:1,5',
            'level'      => 'required',
            'category'   => 'required'
        ]);

        $result = QuizChoice::create([
            'category'   => $this->category,
            'level'      => implode(' , ',$this->level),
            'question'   => $this->question,
            'choice1'    => $this->choice1,
            'choice2'    => $this->choice2,
            'choice3'    => $this->choice3,
            'choice4'    => $this->choice4,
            'choice5'    => $this->choice5,
            'answer'     => $this->answer,
        ]);

        if ($result)
        {
            $this->reset([
                'question',
                'choice1',
                'choice2',
                'choice3',
                'choice4',
                'choice5',
                'answer',
                'category',
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
