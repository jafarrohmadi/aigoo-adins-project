<?php

namespace App\Http\Livewire\Question;

use App\Models\Category;
use App\Models\Question;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public int $paginate = 10;
    public $search, $questionId, $title, $category, $content, $level;

    protected array $updatesQueryString = ['search'];

    protected $listeners
        = [
            'renderOnly'     => '$refresh',
            'deleteQuestion' => 'deleteQuestion',
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
            $query           = Question::latest()->where('title', 'like', '%'.$this->search.'%');
            $this->totalData = $query->count();

        } else {
            $query           = Question::latest();
            $this->totalData = $query->count();
        }
        return view('livewire.question.index', [
            'question' => $query->paginate($this->paginate),
        ]);
    }

    public function getQuestion($id)
    {
        $question         = Question::find($id);
        $this->questionId = $question->id;
        $this->title      = $question->title;
        $this->category   = $question->category;
        $this->content    = $question->content;
        $this->level      = $question->level;
    }

    public function update()
    {
        if ($this->questionId) {
            $question = Question::find($this->questionId);

            $this->validate([
                'title'    => 'required',
                'category' => 'required',
                'content'  => 'required',
                'level'    => 'required',

            ]);
            $result = $question->update([
                'title'    => $this->title,
                'category' => $this->category,
                'content'  => $this->content,
                'level'    => $this->level,
            ]);
        }

        if ($result) {
            $this->reset([
                'title',
                'category',
                'content',
                'level',
            ]);
            $this->emit('closeEditModalSuccess');
        } else {
            $this->emit('closeEditModalFailed');
        }
    }

    public function deleteQuestion($id)
    {
        if ($id) {
            $result = Question::destroy($id);

            if ($result) {
                $this->emit('displayAlertDeleteSuccess');
            } else {
                $this->emit('displayAlertDeleteFailed');
            }
        }
    }
}
