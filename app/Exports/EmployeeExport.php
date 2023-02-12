<?php

namespace App\Exports;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EmployeeExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    use Exportable;
    public function collection()
    {
        $result = Http::sms()->get('/emp/export-csv')->object();
        return collect($result);
    }

    public function headings(): array
    {
        return [
            "name",
            "email",
            "username",
            "nid",
            "mobile",
            "current address",
            "permanent address",
            "total salary",
            "blood  group",
            "employee type",
            "gender",
            "dob",
            "religion"
        ];
    }


}
