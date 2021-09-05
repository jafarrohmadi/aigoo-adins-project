<?php

namespace App\Http\Livewire\QuizGame\Completes;

use App\Models\Category;
use App\Models\QuizComplete;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Create extends Component
{
    /**
     * @var string
     */
    public $question, $choice1, $choice2, $choice3, $choice4, $choice5, $choice6, $level, $category, $categoryList;

    /**
     * @var array
     */
    public array $answer = [];

    /**
     * @return Application|Factory|View
     */
    public function render()
    {
        $this->categoryList = Category::orderby('name', 'asc')->get();

        return view('livewire.quiz-game.completes.create');
    }


    public function store()
    {
        $this->validate([
            'question' => 'required',
            'choice1'  => 'required',
            'choice2'  => 'required',
            'choice3'  => 'required',
            'choice4'  => 'required',
            'choice5'  => 'required',
            'choice6'  => 'required',
            'answer'   => 'required|array',
            'level'    => 'required',
            'category' => 'required',
        ]);

        sort($this->answer);

        $result = QuizComplete::create([
            'question' => $this->question,
            'choice1'  => $this->choice1,
            'choice2'  => $this->choice2,
            'choice3'  => $this->choice3,
            'choice4'  => $this->choice4,
            'choice5'  => $this->choice5,
            'choice6'  => $this->choice6,
            'answer'   => '['.implode(",", $this->answer).']',
            'level'    => $this->level,
            'category' => $this->category,
        ]);

        if ($result) {
            $this->reset([
                'question',
                'choice1',
                'choice2',
                'choice3',
                'choice4',
                'choice5',
                'choice6',
                'answer',
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
