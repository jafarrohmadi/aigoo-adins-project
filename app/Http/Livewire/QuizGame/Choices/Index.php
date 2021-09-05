<?php

namespace App\Http\Livewire\QuizGame\Choices;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\QuizChoice;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Index extends
    Component
{
    use WithPagination;
    use WithFileUploads;

    /**
     * @var int
     */
    public int $paginate = 10;

    /**
     * @var string
     */
    public $search;
    public $questionId;
    public $question;
    public $choice1;
    public $choice2;
    public $choice3;
    public $choice4;
    public $choice5;
    public $answer;
    public $totalData;
    public $level;
    public $category;
    public $categoryList;


    /**
     * @var array|string[]
     */
    protected array $updatesQueryString = ['search'];

    protected $listeners
        = [
            'renderOnly'           => '$refresh',
            'deleteQuestionChoice' => 'deleteQuestionChoice',
        ];

    public function mount()
    {
        $this->search = request()->query('search', $this->search);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingPaginate()
    {
        $this->resetPage();
    }

    public function render()
    {
        $this->categoryList = Category::orderby('name', 'asc')->get();

        $query = QuizChoice::latest();

        if ($this->search) {
            $query = $query->where('question', 'like', '%'.$this->search.'%');
        }

        $this->totalData = $query->count();

        return view('livewire.quiz-game.choices.index', [
            'questionsChoices' => $query->paginate($this->paginate),
        ]);
    }

    public function edit($id)
    {
        $questionChoice   = QuizChoice::find($id);
        $this->questionId = $questionChoice->id;
        $this->question   = $questionChoice->question;
        $this->choice1    = $questionChoice->choice1;
        $this->choice2    = $questionChoice->choice2;
        $this->choice3    = $questionChoice->choice3;
        $this->choice4    = $questionChoice->choice4;
        $this->choice5    = $questionChoice->choice5;
        $this->answer     = $questionChoice->answer;
        $this->category   = $questionChoice->category;
        $this->level      = $questionChoice->level;
    }

    public function update()
    {
        if ($this->questionId) {
            $questionChoice = QuizChoice::find($this->questionId);


            $this->validate([
                'question' => 'required',
                'choice1'  => 'required',
                'choice2'  => 'required',
                'choice3'  => 'required',
                'choice4'  => 'required',
                'choice5'  => 'required',
                'answer'   => 'required|digits_between:1,5',
                'category' => 'required',
                'level'    => 'required',
            ]);


            $result = $questionChoice->update([
                'question' => $this->question,
                'choice1'  => $this->choice1,
                'choice2'  => $this->choice2,
                'choice3'  => $this->choice3,
                'choice4'  => $this->choice4,
                'choice5'  => $this->choice5,
                'answer'   => $this->answer,
                'category' => $this->category,
                'level'    => $this->level,
            ]);
        }

        if ($result) {
            $this->reset([
                'questionId',
                'question',
                'choice1',
                'choice2',
                'choice3',
                'choice4',
                'choice5',
                'answer',
                'category',
                'level',
            ]);
            $this->emit('closeEditModalSuccess'); // Close model to using to jquery when Success
        } else {
            $this->emit('closeEditModalFailed'); // Close model to using to jquery when Failed
        }
    }

    public function deleteQuestionChoice($id)
    {
        if ($id) {
            $result = QuizChoice::destroy($id);

            if ($result) {
                $this->emit('displayAlertDeleteSuccess');
            } else {
                $this->emit('displayAlertDeleteFailed');
            }
        }
    }
}
