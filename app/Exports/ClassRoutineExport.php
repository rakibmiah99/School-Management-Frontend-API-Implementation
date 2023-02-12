<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ClassRoutineExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct($from_date, $end_date, $class, $section)
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
        $url = "/admin/class-routine-report?class_id={$this->class}&section_id={$this->section}&from_date={$this->from_date}&to_date={$this->end_date}";
        $result = Http::sms()->get($url)->object();
        return collect($result);
    }

    public function headings(): array
    {
        return [
            "id",
            "class",
            "section",
            "subject",
            "start_time",
            "end_time",
            "day",
            "teacher",
            "room_number",
            "created_at",
            "updated_at",
            "created_by",
            "updated_by",
            "deleted_by",
            "deleted_at"
        ];
    }
}
