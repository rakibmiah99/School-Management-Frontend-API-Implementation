<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Exports\ClassRoutineExport;
use Maatwebsite\Excel\Facades\Excel;
use Dompdf\Dompdf;
use Dompdf\Options;
class ClassRoutineControler extends Controller
{
    function Page(Request $request){
        $respone = Http::sms()->get("/admin/class-list");
        if($respone->status() === 200){
            $data['activePage'] = "class-routine-report";
            $data['activeMenu'] = "reports";
            $data['title'] = "Class Routine Report | School Management App";
            $data['classes'] = $respone->object();
            return view('pages.Reports.ClassRoutine', $data);
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
        $url = "/admin/class-routine-report?class_id={$class}&section_id={$section}&from_date={$start_date}&to_date={$end_date}";
        $response = Http::sms()->get($url);
        return $response->object();
    }

    function ExportCSV(Request $request){
        $start_date = $request->startDate;
        $end_date = $request->endDate;
        $class = $request->class;
        $section = $request->section;
        return Excel::download(new ClassRoutineExport($start_date, $end_date, $class, $section), $start_date." to ".$end_date.".csv");
    }

    function ExportPDF(Request $request){
        $start_date = $request->startDate;
        $end_date = $request->endDate;
        $class = $request->class;
        $section = $request->section;
        $url = "/admin/class-routine-report?class_id={$class}&section_id={$section}&from_date={$start_date}&to_date={$end_date}";
        $result = Http::sms()->get($url)->object();
//        $result =Http::sms()->get('/emp/export-csv')->object();
        $table = "<table style='font-size: 12px;'>";
        $table .= "<thead>";
        $table .= "<tr>
                     <td>sl</td>
                     <td>class</td>
                     <td>section</td>
                     <td>subject</td>
                     <td>start_time</td>
                     <td>End Time</td>
                     <td>day</td>
                     <td>teacher</td>
                     <td>room_number</td>
                   </tr>";
        $table .= "</thead>";
        $table .= "<tbody>";
        $i = 1;
        foreach($result as $row){
            $index = $i++;
            $table .= "<tr>";
            $table .= "<td>{$index}</td>";
            $table .= "<td>{$row->class}</td>";
            $table .= "<td>{$row->section}</td>";
            $table .= "<td>{$row->subject}</td>";
            $table .= "<td>{$row->start_time}</td>";
            $table .= "<td>{$row->end_time}</td>";
            $table .= "<td>{$row->day}</td>";
            $table .= "<td>{$row->teacher}</td>";
            $table .= "<td>{$row->room_number}</td>";
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
