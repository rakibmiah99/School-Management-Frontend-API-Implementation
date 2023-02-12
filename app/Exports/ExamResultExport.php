<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Concerns\WithHeadings;


class ExamResultExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct($from_date, $end_date, $exam_type, $class, $section)
    {
        $this->from_date = $from_date;
        $this->end_date = $end_date;
        $this->class = $class;
        $this->section = $section;
        $this->exam_type = $exam_type;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    use Exportable;
    public function collection()
    {
//        $url = "/admin/exam-result-report?exam_type={$exam_type}&class={$class}&section={$section}&from_date={$start_date}&to_date={$end_date}";
        $url = "/admin/exam-result-report?exam_type={$this->exam_type}&class={$this->class}&section={$this->section}&from_date={$this->from_date}&to_date={$this->end_date}";
        $result = Http::sms()->get($url)->object();

        return collect($result);
    }

    public function headings(): array
    {
        return [
            "id",
            "exam_id",
            "class",
            "section",
            "subject",
            "student",
            "student_roll",
            "student_reg",
            "marks",
            "exam_date",
            "total_marks",
        ];
    }
}
