<?php

namespace App\Http\Livewire\QuizGame\Matches;

use App\Models\Category;
use App\Models\QuizMatch;
use Livewire\Component;

class Create extends Component
{
    /**
     * @var
     */
    public $question, $wrong_question, $answer, $wrong_answer, $level, $category, $categoryList;

    public function render()
    {
        $this->categoryList = Category::orderby('name', 'asc')->get();
        return view('livewire.quiz-game.matches.create');
    }

    public function store()
    {
        $this->validate([
            'question'       => 'required',
            'wrong_question' => 'required',
            'answer'         => 'required',
            'wrong_answer'   => 'required',
            'level'          => 'required',
            'category'       => 'required',
        ]);

        $result = QuizMatch::create([
            'question'       => $this->question,
            'wrong_question' => $this->wrong_question,
            'answer'         => $this->answer,
            'wrong_answer'   => $this->wrong_answer,
            'level'          => $this->level,
            'category'       => $this->category,
        ]);

        if ($result) {
            $this->reset([
                'question',
                'wrong_question',
                'answer',
                'wrong_answer',
                'level',
                'category',
            ]);
            $this->emit('closeCreateModalSuccess');
        } else {
            $this->emit('closeCreateModalFailed');
        }

        $this->emit('renderOnly');
    }
}
