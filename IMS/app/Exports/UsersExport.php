<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class UsersExport implements FromCollection, WithHeadings, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $users;

    public function __construct($users)
    {
        $this->users = $users;
    }
    public function collection()
    {
        $selectedColumns = collect($this->users)->map(function ($user) {
            return collect($user)->only([
                'fname', 'lname', 'eyear', 'pyear', 'mobile', 'wmobile', 'scnum', 'email', 'workplace',
                'role', 'position', 'qualifications', 'country'
            ])->toArray();
        });


        $users = $selectedColumns->toArray();
        return collect($users);
    }

    public function headings(): array
    {
        return [
            'FName',
            'LName',
            'Entered Year',
            'Pass Out Year',
            'Mobile',
            'WhatsApp Mobile',
            'SC Number',
            'Email',
            'Workplace',
            'Degree',
            'Position',
            'Qualifications',
            'Country'
            // Add more field names as needed
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
