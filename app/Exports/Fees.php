<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\Http;

class Fees implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct($from_date, $end_date)
    {
        $this->from_date = $from_date;
        $this->end_date = $end_date;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    use Exportable;
    public function collection()
    {
        $url = "/admin/fees-history?start_date={$this->from_date}&end_date={$this->end_date}";
        $result = Http::sms()->get($url)->object();
        return collect($result);
    }

}
