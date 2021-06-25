<?php

namespace App\Http\Livewire\QuizGame\Completes;

use App\Models\QuizComplete;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public int $paginate = 10;
    public $search, $questionId, $difficulty, $question, $choice1, $choice2, $choice3, $choice4, $choice5, $choice6, $totalData, $level, $category;
    public array $answer = [];

    protected array $updatesQueryString = ['search'];

    protected $listeners
        = [
            'renderOnly'             => '$refresh',
            'deleteQuestionComplete' => 'deleteQuestionComplete',
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
            $query           = QuizComplete::latest()->where('question', 'like', '%' . $this->search . '%');
            $this->totalData = $query->count();
            return view('livewire.quiz-game.completes.index', [
                'questionsCompletes' => $query->paginate($this->paginate)
            ]);
        } else
        {
            $query           = QuizComplete::latest();
            $this->totalData = $query->count();
            return view('livewire.quiz-game.completes.index', [
                'questionsCompletes' => $query->paginate($this->paginate)
            ]);
        }
    }

    public function getQuestionComplete($id)
    {
        $questionComplete      = QuizComplete::find($id);
        $this->questionId      = $questionComplete->id;
        $this->difficulty      = $questionComplete->difficulty;
        $this->question        = $questionComplete->question;
        $this->choice1         = $questionComplete->choice1;
        $this->choice2         = $questionComplete->choice2;
        $this->choice3         = $questionComplete->choice3;
        $this->choice4         = $questionComplete->choice4;
        $this->choice5         = $questionComplete->choice5;
        $this->choice6         = $questionComplete->choice6;
        $answerRemoveCharacter = trim($questionComplete->answer, "[]");
        $answerArray           = explode(",", $answerRemoveCharacter);
        $this->answer          = $answerArray;
        $this->level           = $questionComplete->level;
        $this->category        = $questionComplete->category;
    }

    public function update()
    {
        if ($this->questionId)
        {
            $questionComplete = QuizComplete::find($this->questionId);

            $this->validate([
                'difficulty' => 'required|digits_between:1,4',
                'question'   => 'required',
                'choice1'    => 'required',
                'choice2'    => 'required',
                'choice3'    => 'required',
                'choice4'    => 'required',
                'choice5'    => 'required',
                'choice6'    => 'required',
                'answer'     => 'required|array',
                'level'      => 'required',
                'category'   => 'required'
            ]);

            sort($this->answer);

            $result = $questionComplete->update([
                'difficulty' => $this->difficulty,
                'question'   => $this->question,
                'choice1'    => $this->choice1,
                'choice2'    => $this->choice2,
                'choice3'    => $this->choice3,
                'choice4'    => $this->choice4,
                'choice5'    => $this->choice5,
                'choice6'    => $this->choice6,
                'answer'     => '[' . implode(",", $this->answer) . ']',
                'level'      => $this->level,
                'category'   => $this->category
            ]);
        }

        if ($result)
        {
            $this->reset([
                'questionId',
                'difficulty',
                'question',
                'choice1',
                'choice2',
                'choice3',
                'choice4',
                'choice5',
                'choice6',
                'answer',
                'level',
                'category'
            ]);
            $this->emit('closeEditModalSuccess');
        } else
        {
            $this->emit('closeEditModalFailed');
        }
    }

    public function deleteQuestionComplete($id)
    {
        if ($id)
        {
            $result = QuizComplete::destroy($id);

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
