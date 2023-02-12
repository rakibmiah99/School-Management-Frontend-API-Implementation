<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StudentDetailsExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct($from_date, $end_date, $class,$section)
    {
        $this->from_date = $from_date;
        $this->end_date = $end_date;
        $this->class = $class;
        $this->section = $section;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    use Exportable;
    public function collection()
    {
        $url = "/admin/student-details-report?class_id={$this->class}&section_id={$this->section}&from_date={$this->from_date}&to_date={$this->end_date}";
        $result = Http::sms()->get($url)->object();

        return collect($result);
    }

    public function headings(): array
    {
        return [
            "id",
            "first_name",
            "last_name",
            "registration_number",
            "user_name",
            "parent_id",
            "birth_registration_no",
            "name",
            "class",
            "roll",
            "section",
            "admission_date",
            "monthly_fee",
            "date_of_birth",
            "gender",
            "mobile_no",
            "email",
            "religion",
            "current_address",
            "permanent_address",
            "blood_group",
            "height",
            "weight",
            "weight_as_on_date",
            "previous_school",
            "drive_name",
            "driver_contact",
            "status",
            "created_at",
            "updated_at",
            "created_by",
            "updated_by",
            "deleted_by",
            "deleted_at",
            "class_data",
            "section_data",
            "gender_data",
            "religion_data",
            "bloodgroup_data",
        ];
    }
}
