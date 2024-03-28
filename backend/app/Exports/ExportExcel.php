<?php

namespace App\Exports;

use App\Models\Team;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
class ExportExcel implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Team::all();
    }
    public function headings(): array
    {
        $headings = [
            'Team_ID',
            'Team_Name',
            'Department_ID',
            'Created_At',
            'Updated_At'
        ];
        return $headings;
    }
}
