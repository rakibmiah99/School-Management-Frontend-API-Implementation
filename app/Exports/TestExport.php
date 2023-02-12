<?php

namespace App\Exports;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TestExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;
    public function collection()
    {
        $result =Http::sms()->get('/student/export-csv')->object();
        return collect($result);
    }

    public function headings(): array
    {
        return [
        "id",
        "name",
        "class",
        "section",
        "roll",
        "registration_number",
        "user_name",
        "nid",
        "birth_registration_no",
        "admission_date",
        "date_of_birth",
        "mobile_no",
        "religion",
        "email",
        "current_address",
        "permanent_address",
        "blood_group",
        "height",
        "weight",
        "weight_as_on_date",
        "previous_school",
        "drive_name",
        "driver_contact"
        ];
    }


}
