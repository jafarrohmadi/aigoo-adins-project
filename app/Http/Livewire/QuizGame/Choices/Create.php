<?php

namespace App\Http\Livewire\QuizGame\Choices;

use App\Models\QuizChoice;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public $question, $choice1, $choice2, $choice3, $choice4, $choice5, $answer, $image, $difficulty, $tempUrl, $category, $level;

    public function updatedImage()
    {
        $this->validate([
            'image' => 'nullable|sometimes|image',
        ]);

        try
        {
            $this->tempUrl = $this->image->temporaryUrl();
        } catch (\Exception $e)
        {
            $this->tempUrl = null; // placeholder image
        }
    }

    public function render()
    {
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
            'image'      => 'nullable|sometimes|image',
            'difficulty' => 'required|digits_between:1,4',
            'level'      => 'required',
            'category'   => 'required'
        ]);

        $imageToShow = $this->image ?? null;

        $result = QuizChoice::create([
            'category'   => $this->category,
            'level'      => $this->level,
            'question'   => $this->question,
            'choice1'    => $this->choice1,
            'choice2'    => $this->choice2,
            'choice3'    => $this->choice3,
            'choice4'    => $this->choice4,
            'choice5'    => $this->choice5,
            'answer'     => $this->answer,
            'image'      => $this->image ? $this->image->store('image/question-game1/choices', 'public') : $imageToShow,
            'difficulty' => $this->difficulty
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
                'image',
                'difficulty',
                'tempUrl',
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
