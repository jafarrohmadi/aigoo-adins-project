<?php

namespace App\Http\Livewire\Category;


use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public int $paginate = 10;
    public $name, $search, $categoryId;

    protected array $updatesQueryString = ['search'];

    protected $listeners
        = [
            'renderOnly' => '$refresh',
            'delete'     => 'delete',
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
            $query           = Category::latest()->where('name', 'like', '%' . $this->search . '%');
            $this->totalData = $query->count();
            return view('livewire.category.index', [
                'category' => $query->paginate($this->paginate)
            ]);
        } else
        {
            $query           = Category::latest();
            $this->totalData = $query->count();
            return view('livewire.category.index', [
                'category' => $query->paginate($this->paginate)
            ]);
        }
    }

    public function getCategory($categoryId)
    {
        $category         = Category::find($categoryId);
        $this->name       = $category->name;
        $this->categoryId = $category->id;
    }

    public function update()
    {
        if ($this->categoryId)
        {
            $questionComplete = Category::find($this->categoryId);

            $this->validate([
                'name' => 'required'
            ]);


            $result = $questionComplete->update([
                'name' => $this->name
            ]);
        }

        if ($result)
        {
            $this->reset([
                'name',
                'categoryId',

            ]);
            $this->emit('closeEditModalSuccess');
        } else
        {
            $this->emit('closeEditModalFailed');
        }
    }

    public function delete($categoryId)
    {
        if ($categoryId)
        {
            $result = Category::destroy($categoryId);

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
