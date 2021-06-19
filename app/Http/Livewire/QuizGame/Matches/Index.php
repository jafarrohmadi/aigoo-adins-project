<?php

namespace App\Http\Livewire\QuestionGame1\Matches;

use App\QuestionMatch;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $paginate = 10;
    public $search;
    public $questionId;
    public $difficulty;
    public $question;
    public $wrong_question;
    public $answer;
    public $wrong_answer;
    public $totalData;
    protected $updatesQueryString = ['search'];

    protected $listeners = [
        'renderOnly' => '$refresh',
        'deleteQuestionMatch' => 'deleteQuestionMatch',
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
        if ($this->search) {
            $query = QuestionMatch::latest()->where('question', 'like', '%' . $this->search . '%');
            $this->totalData = $query->count();
            return view('livewire.question-game1.matches.index', [
                'questionsMatches' => $query->paginate($this->paginate)
            ]);
        } else {
            $query = QuestionMatch::latest();
            $this->totalData = $query->count();
            return view('livewire.question-game1.matches.index', [
                'questionsMatches' => $query->paginate($this->paginate)
            ]);
        }
    }

    public function getQuestionMatch($id)
    {
        $questionMatch = QuestionMatch::find($id);
        $this->questionId = $questionMatch->id;
        $this->difficulty = $questionMatch->difficulty;
        $this->question = $questionMatch->question;
        $this->wrong_question = $questionMatch->wrong_question;
        $this->answer = $questionMatch->answer;
        $this->wrong_answer = $questionMatch->wrong_answer;
    }

    public function update()
    {
        if ($this->questionId) {
            $questionMatch = QuestionMatch::find($this->questionId);

            $this->validate([
                'difficulty' => 'required|digits_between:1,4',
                'question' => 'required',
                'wrong_question' => 'required',
                'answer' => 'required',
                'wrong_answer' => 'required',
            ]);

            $result = $questionMatch->update([
                        'difficulty' => $this->difficulty,
                        'question' => $this->question,
                        'wrong_question' => $this->wrong_question,
                        'answer' => $this->answer,
                        'wrong_answer' => $this->wrong_answer
                    ]);
        }

        if ($result) {
            $this->reset(['questionId', 'difficulty', 'question', 'wrong_question', 'answer', 'wrong_answer']);
            $this->emit('closeEditModalSuccess'); // Close model to using to jquery when Success
        } else {
            $this->emit('closeEditModalFailed'); // Close model to using to jquery when Failed
        }
    }

    public function deleteQuestionMatch($id)
    {
        if ($id) {
            $result = QuestionMatch::destroy($id);

            if ($result) {
                $this->emit('displayAlertDeleteSuccess');
            } else {
                $this->emit('displayAlertDeleteFailed');
            }
        }
    }
}
