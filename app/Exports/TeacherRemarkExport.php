<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TeacherRemarkExport implements FromCollection, WithHeadingRow
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct($month, $class, $section)
    {
        $this->class = $class;
        $this->section = $section;
        $this->month = $month;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    use Exportable;
    public function collection()
    {
//        $url = "/admin/exam-schedule-report?exam_type={$this->exam_type}&class={$this->class}&section={$this->section}&from_date={$this->from_date}&to_date={$this->end_date}";
        $url = "/review/results?class_id={$this->class}&section_id={$this->section}&month={$this->month}";
        $result = Http::sms()->get($url)->object();
        return collect($result);
    }

    public function headings(): array
    {
        return [
            "sl",
            "subject",
            "total_marks",
            "class",
            "section",
            "teacher",
            "guard"
        ];
    }
}
