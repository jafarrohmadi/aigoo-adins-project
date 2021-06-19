<?php

namespace App\Http\Livewire\QuestionGame1\Completes;

use App\Models\QuizChoice;
use App\Models\QuizComplete;
use App\QuestionComplete;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Create extends Component
{
    /**
     * @var string
     */
    public string $difficulty , $question, $choice1 , $choice2, $choice3, $choice4, $choice5 , $choice6;

    /**
     * @var array
     */
    public array $answer = [];

    /**
     * @return Application|Factory|View
     */
    public function render()
    {
        return view('livewire.quiz-game.completes.create');
    }


    public function store()
    {
        $this->validate([
            'difficulty' => 'required|digits_between:1,4',
            'question' => 'required',
            'choice1' => 'required',
            'choice2' => 'required',
            'choice3' => 'required',
            'choice4' => 'required',
            'choice5' => 'required',
            'choice6' => 'required',
            'answer' => 'required|array'
        ]);

        sort($this->answer);

        $result = QuizComplete::create([
            'difficulty' => $this->difficulty,
            'question' => $this->question,
            'choice1' => $this->choice1,
            'choice2' => $this->choice2,
            'choice3' => $this->choice3,
            'choice4' => $this->choice4,
            'choice5' => $this->choice5,
            'choice6' => $this->choice6,
            'answer' => '[' . implode(",", $this->answer) . ']',
        ]);

        if ($result) {
            $this->reset(['difficulty', 'question', 'choice1', 'choice2', 'choice3', 'choice4', 'choice5', 'choice6', 'answer']);
            $this->emit('closeCreateModalSuccess');
        } else {
            $this->emit('closeCreateModalFailed');
        }

        $this->emit('renderOnly');
    }
}
