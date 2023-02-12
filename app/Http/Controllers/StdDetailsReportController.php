<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Exports\StudentDetailsExport;
use Maatwebsite\Excel\Facades\Excel;
use Dompdf\Dompdf;
use Dompdf\Options;
class StdDetailsReportController extends Controller
{
    function Page(Request $request){
        $respone = Http::sms()->get("/admin/class-list");
        if($respone->status() === 200){
            $data['activePage'] = "student-details-report";
            $data['activeMenu'] = "reports";
            $data['title'] = "Student Details Report | School Management App";
            $data['classes'] = $respone->object();
            return view('pages.Reports.StudentDetails', $data);
        }
        else{
            redirect('/login');
        }
    }

    function Get(Request $request){
        $start_date = $request->startDate;
        $end_date = $request->endDate;
        $class = $request->class;
        $section = $request->section;
        $url = "/admin/student-details-report?class_id={$class}&section_id={$section}&from_date={$start_date}&to_date={$end_date}";
        $response = Http::sms()->get($url);
        return $response->object();
    }

    function ExportCSV(Request $request){
        $start_date = $request->startDate;
        $end_date = $request->endDate;
        $class = $request->class;
        $section = $request->section;
        return Excel::download(new StudentDetailsExport($start_date, $end_date, $class, $section), $start_date." to ".$end_date.".csv");
    }

    function ExportPDF(Request $request){
        $start_date = $request->startDate;
        $end_date = $request->endDate;
        $class = $request->class;
        $section = $request->section;
        $url = "/admin/student-details-report?class_id={$class}&section_id={$section}&from_date={$start_date}&to_date={$end_date}";
        $result = Http::sms()->get($url)->object();
//        $result =Http::sms()->get('/emp/export-csv')->object();
        $table = "<table style='font-size: 12px;'>";
        $table .= "<thead>";
        $table .= "<tr>
                        <th>Registration Number</th>
                        <th>Name</th>
                        <th>Class</th>
                        <th>Section</th>
                        <th>Roll</th>
                        <th>Permanent Address</th>
                   </tr>";
        $table .= "</thead>";
        $table .= "<tbody>";
        foreach($result as $row){
            $table .= "<tr>";
            $table .= "<td>{$row->registration_number}</td>";
            $table .= "<td>{$row->name}</td>";
            $table .= "<td>{$row->class}</td>";
            $table .= "<td>{$row->section}</td>";
            $table .= "<td>{$row->roll}</td>";
            $table .= "<td>{$row->permanent_address}</td>";
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
