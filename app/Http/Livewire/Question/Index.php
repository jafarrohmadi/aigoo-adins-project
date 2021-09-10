<?php

namespace App\Http\Livewire\Question;

use App\Models\Category;
use App\Models\Question;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends
    Component
{
    use WithPagination;

    public int $paginate = 10;
    public $search, $questionId, $category, $content, $level, $choice1, $choice2, $choice3, $choice4, $point1, $point2, $point3, $point4, $categoryList, $levelData;

    protected array $updatesQueryString = ['search'];

    protected $listeners
        = [
            'renderOnly'     => '$refresh',
            'deleteQuestion' => 'deleteQuestion',
            'getQuestion'    => '$refresh',
        ];

    public function mount()
    {
        $this->search       = request()->query('search', $this->search);
        $this->categoryList = Category::orderby('name', 'asc')->get();
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
        if ($this->search) {
            $query           = Question::latest()->where('title', 'like', '%'.$this->search.'%');
            $this->totalData = $query->count();

        } else {
            $query           = Question::latest();
            $this->totalData = $query->count();
        }

        return view('livewire.question.index', [
            'question'     => $query->paginate($this->paginate),
            'categoryList' => $this->categoryList,
            'levelData'    => $this->levelData,
        ]);
    }

    public function getQuestion($id)
    {
        $question         = Question::find($id);
        $this->questionId = $question->id;
        $this->category   = $question->category;
        $this->content    = $question->content;
        $this->levelData  = $question->level;
        $this->choice1    = $question->choice1;
        $this->choice2    = $question->choice2;
        $this->choice3    = $question->choice3;
        $this->choice4    = $question->choice4;
        $this->point1     = $question->point1;
        $this->point2     = $question->point2;
        $this->point3     = $question->point3;
        $this->point4     = $question->point4;
        $this->emit('renderOnly');

    }

    public function update()
    {
        if ($this->questionId) {
            $question = Question::find($this->questionId);

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

            $result = $question->update([
                'category' => $this->category,
                'content'  => $this->content,
                'level'    => implode(' , ', $this->level),
                'choice1'  => $this->choice1,
                'choice2'  => $this->choice2,
                'choice3'  => $this->choice3,
                'choice4'  => $this->choice4,
                'point1'   => $this->point1,
                'point2'   => $this->point2,
                'point3'   => $this->point3,
                'point4'   => $this->point4,
            ]);
        }

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
