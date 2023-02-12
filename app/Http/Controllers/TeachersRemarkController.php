<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Exports\TeacherRemarkExport;
use Maatwebsite\Excel\Facades\Excel;
use Dompdf\Dompdf;
use Dompdf\Options;

class TeachersRemarkController extends Controller
{
    function Page(Request $request){
        $respone = Http::sms()->get("/admin/class-list");
        if($respone->status() === 200){
            $data['activePage'] = "";
            $data['activeMenu'] = "teacher-remarks";
            $data['title'] = "Teacher's Remark | School Management App";
            $data['classes'] = $respone->object();
            return view('pages.TeacherRemark', $data);
        }
        else{
            redirect('/login');
        }
    }

    function Get(Request $request){
        $month = $request->month;
        $class = $request->class;
        $section = $request->section;
        $url = "/review/results?class_id=${class}&section_id={$section}&month={$month}";
        $response = Http::sms()->get($url);
        return $response->object();
    }

    function ExportCSV(Request $request){
        $month = $request->month;
        $class = $request->class;
        $section = $request->section;
        $time = strtotime(date('y-m-d'));
        return Excel::download(new TeacherRemarkExport($month, $class, $section), "teacher-remarks-".$time.".csv");
    }

    function ExportPDF(Request $request){
        $month = $request->month;
        $class = $request->class;
        $section = $request->section;

        $url = "/review/results?class_id={$class}&section_id={$section}&month={$month}";
        $result = Http::sms()->get($url)->object();
//        return $result;
//
        $table = "<table style='font-size: 12px;'>";
        $table .= "<thead>";
        $table .= "<tr>
                        <th>SL</th>
                        <th>Month</th>
                        <th>Class</th>
                        <th>Section</th>
                        <th>Teacher</th>
                        <th>Average Review</th>
                   </tr>";
        $table .= "</thead>";
        $table .= "<tbody>";
        foreach($result as $row){
            $table .= "<tr>";
            $table .= "<td>{$row->sl}</td>";
            $table .= "<td>{$row->month}</td>";
            $table .= "<td>{$row->class}</td>";
            $table .= "<td>{$row->section}</td>";
            $table .= "<td>{$row->teacher_name}</td>";
            $table .= "<td>{$row->avg_review}</td>";
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

        $time = strtotime(date('y-m-d'));

        // Output the generated PDF to Browser
        $dompdf->stream("teacher-remarks-".$time.'.pdf');

//        return (new TestExport)->download('students.pdf', \Maatwebsite\Excel\Excel::DOMPDF);
//        return (new TestExport)->download('students.csv', \Maatwebsite\Excel\Excel::CSV);
    }
}
