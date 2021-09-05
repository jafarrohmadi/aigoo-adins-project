<?php

namespace App\Http\Livewire\Question;

use App\Models\Category;
use App\Models\Question;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Create extends
    Component
{
    /**
     * @var string
     */
    public $questionId, $category, $content, $level, $choice1, $choice2, $choice3, $choice4, $point1, $point2, $point3, $point4, $categoryList;

    public function mount()
    {
        $this->choice1      = 'Tidak pernah';
        $this->choice2      = 'Sesekali';
        $this->choice3      = 'Kadang2';
        $this->choice4      = 'Selalu';
        $this->point1       = 1;
        $this->point2       = 2;
        $this->point3       = 3;
        $this->point4       = 4;
        $this->categoryList = Category::orderby('name', 'asc')->get();
    }

    /**
     * @return Application|Factory|View
     */
    public function render()
    {
        return view('livewire.question.create', ['categoryList' => $this->categoryList]);
    }


    public function store()
    {
        $this->validate([
            'category' => 'required',
            'content'  => 'required',
            'level'    => 'required',
            'choice1'  => 'required',
            'choice2'  => 'required',
            'choice3'  => 'required',
            'choice4'  => 'required',
            'point1'   => 'required',
            'point2'   => 'required',
            'point3'   => 'required',
            'point4'   => 'required',
        ]);

        $result = Question::create([
            'category' => $this->category,
            'content'  => $this->content,
            'level'    => $this->level,
            'choice1'  => $this->choice1,
            'choice2'  => $this->choice2,
            'choice3'  => $this->choice3,
            'choice4'  => $this->choice4,
            'point1'   => $this->point1,
            'point2'   => $this->point2,
            'point3'   => $this->point3,
            'point4'   => $this->point4,
        ]);

        if ($result) {
            $this->reset([
                'category',
                'content',
                'level',
                'choice1',
                'choice2',
                'choice3',
                'choice4',
                'point1',
                'point2',
                'point3',
                'point4',
            ]);
            $this->emit('closeCreateModalSuccess');
        } else {
            $this->emit('closeCreateModalFailed');
        }

        $this->emit('renderOnly');
    }
}
