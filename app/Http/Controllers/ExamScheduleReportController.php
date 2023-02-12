<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Exports\ExamScheduleExport;
use Maatwebsite\Excel\Facades\Excel;
use Dompdf\Dompdf;
use Dompdf\Options;
class ExamScheduleReportController extends Controller
{
    function Page(Request $request){
        $respone = Http::sms()->get("/admin/class-list");
        $exam_type = Http::sms()->get("/admin/exam");
        if($respone->status() === 200){
            $data['activePage'] = "exam-schedule-report";
            $data['activeMenu'] = "reports";
            $data['title'] = "Exam Schedule Report | School Management App";
            $data['examType'] = $exam_type->object();
            $data['classes'] = $respone->object();
            return view('pages.Reports.ExamSchedule', $data);
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
        $url = "/admin/exam-schedule-report?exam_type={$exam_type}&class={$class}&section={$section}&from_date={$start_date}&to_date={$end_date}";
        $response = Http::sms()->get($url);
        return $response->object();
    }

    function ExportCSV(Request $request){
        $start_date = $request->startDate;
        $end_date = $request->endDate;
        return Excel::download(new ExamScheduleExport($start_date, $end_date, $request->examType, $request->class, $request->section), $start_date." to ".$end_date.".csv");
    }

    function ExportPDF(Request $request){
        $start_date = $request->startDate;
        $end_date = $request->endDate;
        $exam_type = $request->examType;
        $class = $request->class;
        $section = $request->section;
        $url = "/admin/exam-schedule-report?exam_type={$exam_type}&class={$class}&section={$section}&from_date={$start_date}&to_date={$end_date}";
        $result = Http::sms()->get($url)->object();
//
        $table = "<table style='font-size: 12px;'>";
        $table .= "<thead>";
        $table .= "<tr>
                        <th>Date</th>
                        <th>Subject</th>
                        <th>Total Marks</th>
                        <th>Class</th>
                        <th>Section</th>
                        <th>Teacher</th>
                        <th>Guard</th>
                   </tr>";
        $table .= "</thead>";
        $table .= "<tbody>";
        foreach($result as $row){
            $class = "";
            $section = "";
            $guard = "";
            $teacher = "";
            ($row->class_data != null) ? $class = $row->class_data->name : $class = "";
            ($row->section_data != null) ? $section = $row->section_data->name : $class = "";
            ($row->teacher_data != null) ? $guard = $row->teacher_data->name : $class = "";
            ($row->guard_data != null) ? $guard = $row->guard_data->name : $class = "";


            $table .= "<tr>";
            $table .= "<td>{$row->exam_date}</td>";
            $table .= "<td>{$row->subject_data->name}</td>";
            $table .= "<td>{$row->total_marks}</td>";
            $table .= "<td>{$class}</td>";
            $table .= "<td>{$section}</td>";
            $table .= "<td>{$teacher}</td>";
            $table .= "<td>{$guard}</td>";
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
