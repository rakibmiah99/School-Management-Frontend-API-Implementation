<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StudentAttendaceExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
//    public function __construct($from_date, $end_date, $student_id)
    public function __construct($from_date, $end_date, $class, $section)
    {
        $this->from_date = $from_date;
        $this->end_date = $end_date;
//        $this->student_id = $student_id;
        $this->class = $class;
        $this->section = $section;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    use Exportable;
    public function collection()
    {
//        $url = "admin/student-attendance-report?from_date={$this->from_date}&to_date={$this->end_date}&student_id={$this->student_id}";
        $url = "admin/student-attendance-list?from_date={$this->from_date}&to_date={$this->end_date}&class={$this->class}&section={$this->section}";
        $result = Http::sms()->get($url)->object();

        /*$data = [
            (object)[
                'sl' => "#SL",
                'name' => "Name",
                'class' => "Class",
                'section' => "Section",
                'date' => "Date",
                'remark' => "Remark"
            ]
        ];
        foreach ($result->data as $item){
            $genarate = (object)[
                'sl' => $item->sl,
                'name' => $result->student,
                'class' => $result->class,
                'section' => $result->section,
                'date' => $item->date,
                'remark' => ($item->remark == 0) ? "absent" : "present"
            ];
            array_push($data, $genarate);
        }*/
        return collect($result);
    }

    public function headings(): array
    {
        return [
            "sl",
            "name",
            "date",
            "remark"
        ];
    }
}
