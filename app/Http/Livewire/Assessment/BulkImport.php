<?php

namespace App\Http\Livewire\Assessment;

use App\Exports\AssessmentExport;
use App\Models\Assessment;
use App\Models\Department;
use App\Models\User;
use File;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use ZipArchive;


class BulkImport extends
    Component
{
    use WithPagination;

    public int $paginate = 10;
    public $selectDate, $selectName, $endDate, $selectDepartment;


    protected $listeners
        = [
            'renderOnly' => '$refresh',
        ];

    public function render()
    {
        $department = Cache::remember('department123', '300', function () {
            return Department::all();
        });

        return view('livewire.assessment.filter-bulk-import', [
            'department' => $department,
        ]);

    }

    public function downloadExcel()
    {
        $query = Assessment::where('assessment_info', null)->with('assessor', 'user', 'question')->groupBy('user_id',
            'assessor_id', 'assessment_year_month');

        if ($this->selectDepartment != null) {
            $query = $query->whereHas('user', function ($q) {
                $q->where('department_id', $this->selectDepartment);
            });
        }

        if ($this->selectDate != null) {
            $query = $query->where('created_at', '>=', date('Y-m-d 00:00:00', strtotime($this->selectDate)));
        }

        if ($this->endDate != null) {
            $query = $query->where('created_at', '<=', date('Y-m-d 23:59:59', strtotime($this->endDate)));
        }

        $data = $query->get()->groupBy('user_id');
        if(count($data) > 0) {
            foreach ($data as $datas) {
                Excel::store(new AssessmentExport($datas),
                    date('Y-m-d').'/'.$datas[0]->user->department_name.'/assessment-'.date('Y-m-d').'-'.$datas[0]->user->name.'.xlsx');
            }

            $zip = new ZipArchive;

            $zipFilename = 'app/'.date('Y-m-d').'.zip';
            File::cleanDirectory(public_path('app/'));

            $rootPath = storage_path('app/'.date('Y-m-d'));

            $zip = new ZipArchive();
            $zip->open($zipFilename, ZipArchive::CREATE | ZipArchive::OVERWRITE);

            /** @var SplFileInfo[] $files */
            $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($rootPath),
                RecursiveIteratorIterator::LEAVES_ONLY);

            foreach ($files as $name => $file) {
                $filePath     = $file->getRealPath();
                $relativePath = substr($filePath, strlen($rootPath) + 1);

                if (!$file->isDir()) {
                    $zip->addFile($filePath, $relativePath);
                } else {
                    if ($relativePath !== false) {
                        $zip->addEmptyDir($relativePath);
                    }
                }
            }

            $zip->close();
            File::deleteDirectory($rootPath);
            return response()->download(public_path($zipFilename));
        }else{
            session()->flash('error', 'Data Not Found');
            return;
        }
    }


}
