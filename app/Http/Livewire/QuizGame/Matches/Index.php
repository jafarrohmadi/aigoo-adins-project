<?php

namespace App\Http\Livewire\QuizGame\Matches;

use App\Models\QuizMatch;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $paginate = 10;
    public $search, $questionId, $difficulty, $question, $wrong_question, $answer, $wrong_answer, $totalData, $category, $level;
    protected $updatesQueryString = ['search'];

    protected $listeners
        = [
            'renderOnly'          => '$refresh',
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
        if ($this->search)
        {
            $query = QuizMatch::latest()->where('question', 'like', '%' . $this->search . '%');
        } else
        {
            $query = QuizMatch::latest();
        }

        $this->totalData = $query->count();
        return view('livewire.quiz-game.matches.index', [
            'questionsMatches' => $query->paginate($this->paginate)
        ]);
    }

    public function getQuestionMatch($id)
    {
        $questionMatch        = QuizMatch::find($id);
        $this->questionId     = $questionMatch->id;
        $this->difficulty     = $questionMatch->difficulty;
        $this->question       = $questionMatch->question;
        $this->wrong_question = $questionMatch->wrong_question;
        $this->answer         = $questionMatch->answer;
        $this->wrong_answer   = $questionMatch->wrong_answer;
        $this->category       = $questionMatch->category;
        $this->level          = $questionMatch->level;
    }

    public function update()
    {
        if ($this->questionId)
        {
            $questionMatch = QuizMatch::find($this->questionId);

            $this->validate([
                'difficulty'     => 'required|digits_between:1,4',
                'question'       => 'required',
                'wrong_question' => 'required',
                'answer'         => 'required',
                'wrong_answer'   => 'required',
                'category'       => 'required',
                'level'          => 'required'
            ]);

            $result = $questionMatch->update([
                'difficulty'     => $this->difficulty,
                'question'       => $this->question,
                'wrong_question' => $this->wrong_question,
                'answer'         => $this->answer,
                'wrong_answer'   => $this->wrong_answer,
                'category'       => $this->category,
                'level'          => $this->level
            ]);
        }

        if ($result)
        {
            $this->reset(['questionId', 'difficulty', 'question', 'wrong_question', 'answer', 'wrong_answer']);
            $this->emit('closeEditModalSuccess'); // Close model to using to jquery when Success
        } else
        {
            $this->emit('closeEditModalFailed'); // Close model to using to jquery when Failed
        }
    }

    public function deleteQuestionMatch($id)
    {
        if ($id)
        {
            $result = QuizMatch::destroy($id);

            if ($result)
            {
                $this->emit('displayAlertDeleteSuccess');
            } else
            {
                $this->emit('displayAlertDeleteFailed');
            }
        }
    }
}
