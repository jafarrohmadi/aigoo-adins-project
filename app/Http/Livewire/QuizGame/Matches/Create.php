<?php

namespace App\Http\Livewire\QuizGame\Matches;

use App\Models\QuizMatch;
use Livewire\Component;

class Create extends Component
{
    public string $difficulty;
    public $question, $wrong_question , $answer, $wrong_answer;

    public function render()
    {
        return view('livewire.question-game1.matches.create');
    }

    public function store()
    {
        $this->validate([
            'difficulty' => 'required|digits_between:1,4',
            'question' => 'required',
            'wrong_question' => 'required',
            'answer' => 'required',
            'wrong_answer' => 'required',
        ]);

        $result = QuizMatch::create([
            'difficulty' => $this->difficulty,
            'question' => $this->question,
            'wrong_question' => $this->wrong_question,
            'answer' => $this->answer,
            'wrong_answer' => $this->wrong_answer
        ]);

        if ($result) {
            $this->reset(['difficulty', 'question', 'wrong_question', 'answer', 'wrong_answer']);
            $this->emit('closeCreateModalSuccess'); // Close model to using to jquery when Success
        } else {
            $this->emit('closeCreateModalFailed'); // Close model to using to jquery when Failed
        }

        $this->emit('renderOnly');
    }
}
