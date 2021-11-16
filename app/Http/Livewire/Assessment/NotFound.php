<?php

namespace App\Http\Livewire\Assessment;

use App\Models\Assessment;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class NotFound extends
    Component
{
    use WithPagination;
    use WithFileUploads;

    public $date, $totalData;
    /**
     * @var int
     */
    public int $paginate = 10;

    /**
     * @var string
     */
    public $search;

    /**
     * @var array|string[]
     */
    protected array $updatesQueryString = ['search'];

    protected $listeners
        = [
            'renderOnly' => '$refresh',

        ];

    public function mount()
    {
        $this->search = request()->query('search', $this->search);
        $this->date = date('Y-m');
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
        $assessmentData = Assessment::select('assessor_id')->where('assessment_year_month',
            date('Y-m',strtotime($this->date)))->groupBy('assessor_id')->get()->pluck('assessor_id')->toArray();

        $query          = User::whereNotIn('id', $assessmentData);

      /*  if($this->date){
            $query= $query->where('created_at', '<=', (date('Y-m',strtotime($this->date)) . '-01'));
        }*/
        if ($this->search) {
            $query = $query->where(function ($row){
                $row->where('name', 'like', '%'.$this->search.'%')->orwhere('department', 'like',
                    '%'.$this->search.'%')
                    ->orwhere('roles', 'like', '%'.$this->search.'%');
            })->orderBy('name', 'asc');
        }

        $this->totalData = $query->count();

     //   $user_count       = User::where('created_at', '<=', (date('Y-m',strtotime($this->date)) . '-01'))->count();
        $user_count       = User::count();

        $user_have_assessment = count(Assessment::where('assessment_year_month' , date('Y-m',strtotime($this->date)))->groupBy('assessor_id')->get());
        $user_dont_have_assessment = $user_count - $user_have_assessment;

        return view('livewire.assessment.not-found', [
            'user' => $query->paginate($this->paginate),
            'user_count' => $user_count,
            'user_have_assessment' => $user_have_assessment,
            'user_dont_have_assessment' => $user_dont_have_assessment
        ]);
    }


}
