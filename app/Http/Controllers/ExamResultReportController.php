<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Exports\ExamResultExport;
use Maatwebsite\Excel\Facades\Excel;
use Dompdf\Dompdf;
use Dompdf\Options;
class ExamResultReportController extends Controller
{
    function Page(Request $request){
        $respone = Http::sms()->get("/admin/class-list");
        $exam_type = Http::sms()->get("/admin/exam");
        if($respone->status() === 200){
            $data['activePage'] = "exam-result-report";
            $data['activeMenu'] = "reports";
            $data['title'] = "Exam Result Report | School Management App";
            $data['examType'] = $exam_type->object();
            $data['classes'] = $respone->object();
            return view('pages.Reports.ExamResult', $data);
        }
        else{
            redirect('/login');
        }
    }

    function Get(Request $request){
        $start_date = $request->startDate;
        $end_date = $request->endDate;
        $exam_type = $request->examType;
        $class = $request->class;
        $section = $request->section;
        $url = "/admin/exam-result-report?exam_type={$exam_type}&class={$class}&section={$section}&from_date={$start_date}&to_date={$end_date}";
        $response = Http::sms()->get($url);
        return $response->object();
    }

    function ExportCSV(Request $request){
        $start_date = $request->startDate;
        $end_date = $request->endDate;
        return Excel::download(new ExamResultExport($start_date, $end_date, $request->examType, $request->class, $request->section), $start_date." to ".$end_date.".csv");
    }

    function ExportPDF(Request $request){
        $start_date = $request->startDate;
        $end_date = $request->endDate;
        $exam_type = $request->examType;
        $class = $request->class;
        $section = $request->section;
        $url = "/admin/exam-result-report?exam_type={$exam_type}&class={$class}&section={$section}&from_date={$start_date}&to_date={$end_date}";
        $result = Http::sms()->get($url)->object();
//
        $table = "<table style='font-size: 12px;'>";
        $table .= "<thead>";
        $table .= "<tr>
                        <th>Date</th>
                        <th>Roll Number</th>
                        <th>Name</th>
                        <th>Class</th>
                        <th>Section</th>
                        <th>Subject</th>
                        <th>Total Marks</th>
                        <th>Obtained Marks</th>
                   </tr>";
        $table .= "</thead>";
        $table .= "<tbody>";
        foreach($result as $row){
            $table .= "<tr>";
            $table .= "<td>{$row->exam_date}</td>";
            $table .= "<td>{$row->student_roll}</td>";
            $table .= "<td>{$row->student}</td>";
            $table .= "<td>{$row->class}</td>";
            $table .= "<td>{$row->section}</td>";
            $table .= "<td>{$row->subject}</td>";
            $table .= "<td>{$row->total_marks}</td>";
            $table .= "<td>{$row->marks}</td>";
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
