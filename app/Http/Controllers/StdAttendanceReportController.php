<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Exports\StudentAttendaceExport;
use Maatwebsite\Excel\Facades\Excel;
use Dompdf\Dompdf;
use Dompdf\Options;
class StdAttendanceReportController extends Controller
{
    function Page(Request $request){
        $respone = Http::sms()->get("/admin/class-list");
        if($respone->status() === 200){
            $data['activePage'] = "student-attendance-report";
            $data['activeMenu'] = "reports";
            $data['title'] = "Attendance Report | School Management App";
            $data['classes'] = $respone->object();
            return view('pages.Reports.StudentAttendanceReport', $data);
        }
        else{
            redirect('/login');
        }
    }

    function Get(Request $request){
        $start_date = $request->startDate;
        $end_date = $request->endDate;
//        $student_id = $request->student_id;
        $url = "admin/student-attendance-list?from_date={$start_date}&to_date={$end_date}&class={$request->class}&section={$request->section}";
//        $url = "admin/student-attendance-report?from_date={$start_date}&to_date={$end_date}&student_id={$student_id}";
        $response = Http::sms()->get($url);
        return $response->object();
    }

    function ExportCSV(Request $request){
        $start_date = $request->startDate;
        $end_date = $request->endDate;
        $student_id = $request->student_id;
//        return Excel::download(new StudentAttendaceExport($start_date, $end_date, $student_id), $start_date." to ".$end_date.".csv");
        return Excel::download(new StudentAttendaceExport($start_date, $end_date, $request->class, $request->section), $start_date." to ".$end_date.".csv");
    }

    function ExportPDF(Request $request){
        $start_date = $request->startDate;
        $end_date = $request->endDate;
        $student_id = $request->student_id;
        $url = "admin/student-attendance-list?from_date={$start_date}&to_date={$end_date}&class={$request->class}&section={$request->section}";
//        $url = "admin/student-attendance-report?from_date={$start_date}&to_date={$end_date}&student_id={$student_id}";
        $result = Http::sms()->get($url)->object();
//        $result =Http::sms()->get('/emp/export-csv')->object();
        $table = "<table style='font-size: 12px;'>";
        $table .= "<thead>";
        $table .= "<tr>
                     <td>SL</td>
                     <td>Name</td>
                     <td>Class</td>
                     <td>Section</td>
                     <td>Date</td>
                     <td>Remark</td>
                   </tr>";
        $table .= "</thead>";
        $table .= "<tbody>";
//        foreach($result->data as $row){
        foreach($result as $row){
            $table .= "<tr>";
            $table .= "<td>{$row->sl}</td>";
            $table .= "<td>{$row->student}</td>";
            $table .= "<td>{$request->class}</td>";
            $table .= "<td>{$request->section}</td>";
            $table .= "<td>{$row->date}</td>";

            $remark = "present";
            if($row->remark == "0"){$remark = "absent";}
            $table .= "<td>{$remark}</td>";
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
