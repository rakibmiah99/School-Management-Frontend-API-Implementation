<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Exports\ComplainExport;
use Maatwebsite\Excel\Facades\Excel;
use Dompdf\Dompdf;
use Dompdf\Options;
class ComplainsController extends Controller
{
    function Page(){
        $data ['activeMenu'] = 'complains';
        $data ['activePage'] = 'complains';
        $data ['title'] = 'Complains | School Management App';
        return view('pages.ComplainsPage', $data);
    }

    function Get(Request $request){
        $start_date = $request->startDate;
        $end_date = $request->endDate;
        $url = "/compalin?from_date={$start_date}&to_date={$end_date}";
        $response = Http::sms()->get($url);
        return $response->object();
    }

    function ExportCSV(Request $request){
        $start_date = $request->startDate;
        $end_date = $request->endDate;
        return Excel::download(new ComplainExport($start_date, $end_date), $start_date." to ".$end_date.".csv");
    }

    function ExportPDF(Request $request){
        $start_date = $request->startDate;
        $end_date = $request->endDate;
        $url = "/compalin?from_date={$start_date}&to_date={$end_date}";
        $result = Http::sms()->get($url)->object();

//        $result =Http::sms()->get('/emp/export-csv')->object();
        $table = "<table style='font-size: 12px;'>";
        $table .= "<thead>";
        $table .= "<tr>
                        <th>SL</th>
                        <th>Date</th>
                        <th>Parent Name</th>
                        <th>Student's Name</th>
                        <th>Class</th>
                        <th>Section</th>
                        <th>Title</th>
                        <th>Details</th>
                   </tr>";
        $table .= "</thead>";
        $table .= "<tbody>";
        $i = 1;
        $no_data = "No Data found.";
        foreach($result as $row){
            $index = $i++;
            $parent = ($row->parents != null) ? $row->parents->name : $no_data;
            $student = ($row->students != null) ? $row->students->name : $no_data;
            $class = ($row->class_data != null) ? $row->class_data->name : $no_data;
            $section = ($row->sections != null) ? $row->sections->name : $no_data;
            $table .= "<tr>";
            $table .= "<td>{$index}</td>";
            $table .= "<td>{$row->date}</td>";
            $table .= "<td>{$parent}</td>";
            $table .= "<td>{$student}</td>";
            $table .= "<td>{$class}</td>";
            $table .= "<td>{$section}</td>";
            $table .= "<td>{$row->title}</td>";
            $table .= "<td>{$row->details}</td>";
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
