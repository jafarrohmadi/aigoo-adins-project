<?php

namespace App\Exports;

use App\Models\Assessment;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AssessmentExport implements
    FromCollection,
    WithHeadings,
    WithMapping
{
    protected $number, $collectionData;

    public function __construct($collection)
    {
        $this->collectionData = $collection;
        $this->number     = 1;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return $this->collectionData;
    }

    public function headings(): array
    {
        return [
            'No',
            'Assessor',
            'Role',
            'User',
            'Date',
        ];
    }

    public function map($row): array
    {
        $assessorRole = '';
        if ($row->user->id == $row->assessor->id) {
            $assessorRole = 'Diri Sendiri';
        } else {
            if ($row->assessor->id == $row->user->supervisor_id) {
                $assessorRole = 'Atasan';
            }

            if ($row->assessor->supervisor_id == $row->user->id) {
                $assessorRole = 'Bawahan';
            }

            if ($row->user->department == $row->assessor->department) {
                $assessorRole = 'Satu Tim';
            }

            if ($row->user->department != $row->assessor->department) {
                $assessorRole = 'Beda Tim';
            }
        }

        return [
            $this->number++,
            $row->assessor ? ($row->assessor->name.' ('.$row->assessor->department.')') : '',
            $assessorRole,
            $row->user ? ($row->user->name. ' ('. $row->user->department .')') : '',
            date('d F Y', strtotime($row->created_at))
        ];
    }
}
