<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Exports\AccountReportExport;
use Maatwebsite\Excel\Facades\Excel;
use Dompdf\Dompdf;
use Dompdf\Options;
class AccountReportController extends Controller
{
    function Page(Request $request){
        $data['activePage'] = "account-report";
        $data['activeMenu'] = "reports";
        $data['title'] = "Accounts Report | School Management App";
        return view('pages.Reports.Account', $data);
    }

    function Get(Request $request){
        $start_date = $request->startDate;
        $end_date = $request->endDate;
        $url = "/admin/accounts-report?from_date={$start_date}&to_date={$end_date}";
        $response = Http::sms()->get($url);
        return $response->object();
    }

    function ExportCSV(Request $request){
        $start_date = $request->startDate;
        $end_date = $request->endDate;
        return Excel::download(new AccountReportExport($start_date, $end_date), $start_date." to ".$end_date.".csv");
    }

    function ExportPDF(Request $request){
        $start_date = $request->startDate;
        $end_date = $request->endDate;
        $url = "/admin/accounts-report?from_date={$start_date}&to_date={$end_date}";
        $result = Http::sms()->get($url)->object();
//        $result =Http::sms()->get('/emp/export-csv')->object();
        $table = "<table style='font-size: 12px;'>";
        $table .= "<thead>";
        $table .= "<tr>
                     <td>SL</td>
                     <td>Date</td>
                     <td>Title</td>
                     <td>Transaction Type</td>
                     <td>Amount (Income)</td>
                     <td>Amount (Expense)</td>
                   </tr>";
        $table .= "</thead>";
        $table .= "<tbody>";
        foreach($result as $row){
            $table .= "<tr>";
                $table .= "<td>{$row->sl}</td>";
                $table .= "<td>{$row->date}</td>";
                $table .= "<td>{$row->title}</td>";
                $table .= "<td>{$row->transaction_type}</td>";
                $table .= "<td>{$row->inc_amount}</td>";
                $table .= "<td>{$row->exp_amount}</td>";
            $table .= "</tr>";
        }
        $table .= "</tbody>";
        $table .= "</table>";

        $options = new Options();
        $options->set('defaultFont', 'Courier');


        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($table);

        // (Optional) Setup the paper size and orientation
//        $dompdf->setPaper('legal', 'landscape');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream($start_date." to ".$end_date.'.pdf');

//        return (new TestExport)->download('students.pdf', \Maatwebsite\Excel\Excel::DOMPDF);
//        return (new TestExport)->download('students.csv', \Maatwebsite\Excel\Excel::CSV);
    }

}
