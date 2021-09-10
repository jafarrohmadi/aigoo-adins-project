<?php

namespace App\Http\Livewire\QuizGame\Matches;

use App\Models\Category;
use App\Models\QuizMatch;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends
    Component
{
    use WithPagination;

    public $paginate = 10;
    public $search, $questionId, $question, $wrong_question, $answer, $wrong_answer, $totalData, $category, $level, $categoryList, $levelData;
    protected $updatesQueryString = ['search'];

    protected $listeners
        = [
            'renderOnly'          => '$refresh',
            'deleteQuestionMatch' => 'deleteQuestionMatch',
            'getQuestionMatch'    => '$refresh',
        ];

    public function mount()
    {
        $this->search    = request()->query('search', $this->search);
        $this->levelData = 'Staff';
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

        if ($this->search) {
            $query = QuizMatch::latest()->where('question', 'like', '%'.$this->search.'%');
        } else {
            $query = QuizMatch::latest();
        }

        $this->totalData = $query->count();
        return view('livewire.quiz-game.matches.index', [
            'questionsMatches' => $query->paginate($this->paginate),
            'levelData'        => $this->levelData,
        ]);
    }

    public function getQuestionMatch($id)
    {
        $questionMatch        = QuizMatch::find($id);
        $this->questionId     = $questionMatch->id;
        $this->question       = $questionMatch->question;
        $this->wrong_question = $questionMatch->wrong_question;
        $this->answer         = $questionMatch->answer;
        $this->wrong_answer   = $questionMatch->wrong_answer;
        $this->category       = $questionMatch->category;
        $this->levelData      = $questionMatch->level;
        $this->emit('renderOnly');
    }

    public function update()
    {
        if ($this->questionId) {
            $questionMatch = QuizMatch::find($this->questionId);

            $this->validate([
                'question'       => 'required',
                'wrong_question' => 'required',
                'answer'         => 'required',
                'wrong_answer'   => 'required',
                'category'       => 'required',
                'level'          => 'required',
            ]);

            $result = $questionMatch->update([
                'question'       => $this->question,
                'wrong_question' => $this->wrong_question,
                'answer'         => $this->answer,
                'wrong_answer'   => $this->wrong_answer,
                'category'       => $this->category,
                'level'          => implode(' , ', $this->level),
            ]);
        }

        if ($result) {
            $this->reset([
                'questionId',
                'question',
                'wrong_question',
                'answer',
                'wrong_answer',
            ]);
            $this->emit('closeEditModalSuccess'); // Close model to using to jquery when Success
        } else {
            $this->emit('closeEditModalFailed'); // Close model to using to jquery when Failed
        }
    }

    public function deleteQuestionMatch($id)
    {
        if ($id) {
            $result = QuizMatch::destroy($id);

            if ($result) {
                $this->emit('displayAlertDeleteSuccess');
            } else {
                $this->emit('displayAlertDeleteFailed');
            }
        }
    }
}
