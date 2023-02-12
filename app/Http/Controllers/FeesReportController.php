<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Exports\Fees;
use Maatwebsite\Excel\Facades\Excel;
use Dompdf\Dompdf;
use Dompdf\Options;

class FeesReportController extends Controller
{
    function Page(Request $request){
        $data['activePage'] = "fees-report";
        $data['activeMenu'] = "reports";
        $data['title'] = "Fees Report | School Management App";
        return view('pages.Reports.Fees ', $data);
    }

    function Get(Request $request){
        $start_date = $request->startDate;
        $end_date = $request->endDate;
        $url = "/admin/fees-history?start_date={$start_date}&end_date={$end_date}";
        $response = Http::sms()->get($url);
        return $response->object();
    }

    function ExportCSV(Request $request){
        $start_date = $request->startDate;
        $end_date = $request->endDate;
        return Excel::download(new Fees($start_date, $end_date), $start_date." to ".$end_date.".csv");
    }

    function ExportPDF(Request $request){
        $start_date = $request->startDate;
        $end_date = $request->endDate;
        $url = "/admin/fees-history?start_date={$start_date}&end_date={$end_date}";
        $result = Http::sms()->get($url)->object();
//        $result =Http::sms()->get('/emp/export-csv')->object();
        $table = "<table style='font-size: 12px;'>";
        $table .= "<thead>";
        $table .= "<tr>
                        <th>SL</th>
                        <th>Date</th>
                        <th>Name</th>
                        <th>User Type</th>
                        <th>Fee Type</th>
                        <th>Paid Amount</th>
                   </tr>";
        $table .= "</thead>";
        $table .= "<tbody>";
        $i = 1;
        foreach($result as $row){
            $sl = $i++;
            $student = ($row->student_data) ? $row->student_data->name : "-";
            $fee_type = ($row->fee_type) ? $row->fee_type->name : "-";
            $table .= "<tr>";
                $table .= "<td>{$sl}</td>";
                $table .= "<td>{$row->payment_date}</td>";
                $table .= "<td>{$student}</td>";
                $table .= "<td>student</td>";
                $table .= "<td>{$fee_type}</td>";
                $table .= "<td>{$row->payment_amount}</td>";
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
