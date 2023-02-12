<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\Http;

class ExamScheduleExport implements FromCollection
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
        $url = "/admin/exam-schedule-report?exam_type={$this->exam_type}&class={$this->class}&section={$this->section}&from_date={$this->from_date}&to_date={$this->end_date}";
//        $url = "admin/student-attendance-report?from_date={$this->from_date}&to_date={$this->end_date}&student_id={$this->student_id}";
        $result = Http::sms()->get($url)->object();

        $data = [
            (object)[
                'date' => "date",
                'subject' => "subject",
                'total_marks' => "total_marks",
                'class' => "class",
                'section' => "section",
                'teacher' => "teacher",
                'guard' => "guard",
            ]
        ];
        foreach ($result as $item){
            $genarate = (object)[
                'date' => $item->exam_date,
                'subject' => $item->subject_data->name,
                'total_marks' => $item->total_marks,
                'class' => ($item->class_data != null) ? $item->class_data->name : "",
                'section' => ($item->section_data != null) ? $item->section_data->name : "" ,
                'teacher' => ($item->teacher_data != null) ? $item->teacher_data->name : "",
                'guard' => ($item->guard_data != null) ? $item->guard_data->name : ""
            ];

            array_push($data, $genarate);
        }
        return collect($data);
    }

    public function headings(): array
    {
        return [
            "date",
            "subject",
            "total_marks",
            "class",
            "section",
            "teacher",
            "guard"
        ];
    }
}
