<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Exports\EmployeeDetailsExport;
use Maatwebsite\Excel\Facades\Excel;
use Dompdf\Dompdf;
use Dompdf\Options;
class EmpDetailsReportControoler extends Controller
{
    function Page(Request $request){
        $employeeType = Http::sms()->get("/admin/dropdown-items?name=employeetype");
        if($employeeType->status() === 200){
            $data['activePage'] = "employee-details-report";
            $data['activeMenu'] = "reports";
            $data['title'] = "Employee Details Report | School Management App";
            $data['employeeType'] = $employeeType->object();
            return view('pages.Reports.EmployeeDetails', $data);
        }
        else{
            return redirect('/login');
        }
    }

    function Get(Request $request){
        $start_date = $request->startDate;
        $end_date = $request->endDate;
        $url = "/admin/employee-details-report?type={$request->type}&from_date={$start_date}&to_date={$end_date}";
        $response = Http::sms()->get($url);
        return $response->object();
    }

    function ExportCSV(Request $request){
        $start_date = $request->startDate;
        $end_date = $request->endDate;
        return Excel::download(new EmployeeDetailsExport($request->type,$start_date, $end_date), $start_date." to ".$end_date.".csv");
    }

    function ExportPDF(Request $request){
        $start_date = $request->startDate;
        $end_date = $request->endDate;
        $url = "/admin/employee-details-report?type={$request->type}&from_date={$start_date}&to_date={$end_date}";
        $result = Http::sms()->get($url)->object();
//        $result =Http::sms()->get('/emp/export-csv')->object();
        $table = "<table style='font-size: 12px;'>";
        $table .= "<thead>";
        $table .= "<tr>
                     <td>employee_id</td>
                     <td>first_name</td>
                     <td>last_name</td>
                     <td>name</td>
                     <td>mobile</td>
                     <td>email</td>
                     <td>current_address</td>
                     <td>permanent_address</td>
                     <td>total_salary</td>
                     <td>nid</td>
                     <td>gender</td>
                     <td>dob</td>
                     <td>religion</td>
                     <td>blood_group</td>
                     <td>employee_type</td>
                   </tr>";
        $table .= "</thead>";
        $table .= "<tbody>";
        foreach($result as $row){
            $table .= "<tr>";
            $table .= "<td>{$row->employee_id}</td>";
            $table .= "<td>{$row->first_name}</td>";
            $table .= "<td>{$row->last_name}</td>";
            $table .= "<td>{$row->name}</td>";
            $table .= "<td>{$row->mobile}</td>";
            $table .= "<td>{$row->email}</td>";
            $table .= "<td>{$row->current_address}</td>";
            $table .= "<td>{$row->permanent_address}</td>";
            $table .= "<td>{$row->total_salary}</td>";
            $table .= "<td>{$row->nid}</td>";
            $table .= "<td>{$row->gender}</td>";
            $table .= "<td>{$row->dob}</td>";
            $table .= "<td>{$row->religion}</td>";
            $table .= "<td>{$row->blood_group}</td>";
            $table .= "<td>{$row->employee_type}</td>";
            $table .= "</tr>";
        }
        $table .= "</tbody>";
        $table .= "</table>";

        $options = new Options();
        $options->set('defaultFont', 'Courier');


        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($table);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('legal', 'landscape');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream($start_date." to ".$end_date.'.pdf');

//        return (new TestExport)->download('students.pdf', \Maatwebsite\Excel\Excel::DOMPDF);
//        return (new TestExport)->download('students.csv', \Maatwebsite\Excel\Excel::CSV);
    }
}
