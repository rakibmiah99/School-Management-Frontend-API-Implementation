<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Concerns\WithHeadings;


class AccountReportExport implements FromCollection, WithHeadings
{

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
        $url = "/admin/accounts-report?from_date={$this->from_date}&to_date={$this->end_date}";
        $result = Http::sms()->get($url)->object();
        return collect($result);
    }

    public function headings(): array
    {
        return [
            "sl",
            "date",
            "title",
            "transaction_type",
            "inc_amount",
            "exp_amount"
        ];
    }
}
