<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EmployeeDetailsExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct($type, $from_date, $end_date)
    {
        $this->from_date = $from_date;
        $this->end_date = $end_date;
        $this->type = $type;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    use Exportable;
    public function collection()
    {
        $url = "/admin/employee-details-report?type={$this->type}&from_date={$this->from_date}&to_date={$this->end_date}";
        $result = Http::sms()->get($url)->object();
        return collect($result);
    }

    public function headings(): array
    {
        return [
            "id",
            "employee_id",
            "first_name",
            "last_name",
            "user_name",
            "name ",
            "mobile",
            "email",
            "current_address",
            "permanent_address",
            "total_salary",
            "nid",
            "dob",
            "religion",
            "blood_group",
            "employee_type",
            "created_at",
            "updated_at",
            "updated_by",
            "deleted_by",
            "deleted_at",
        ];
    }
}
