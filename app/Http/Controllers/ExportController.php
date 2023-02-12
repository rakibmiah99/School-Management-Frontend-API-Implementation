<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Exports\TestExport;
use App\Exports\EmployeeExport;
use Maatwebsite\Excel\Facades\Excel;
use Dompdf\Dompdf;
use Dompdf\Options;
class ExportController extends Controller
{

    /**************************************
    ------------Student Section ----------
     ***************************************/
    function StudentExportPage(){
        $data['activeMenu'] = 'student';
        $data['activePage'] = 'studentExport';
        $data['title'] = 'All Student Export | School Management App';

        return view('pages.Student.ExportStudent', $data);
    }

    function StudentExportPDF(){
        $result =Http::sms()->get('/student/export-csv')->object();
        $table = "<table style='font-size: 10px;'>";
        $table .= "<thead>";
        $table .= "<tr>
                     <td>#</td>
                     <td>Name</td>
                     <td>class</td>
                     <td>section</td>
                     <td>roll</td>
                     <td>Reg No</td>
                     <td>user_name</td>
                     <td>NID</td>
                     <td>Birth Reg No</td>
                     <td>Admission Date</td>
                     <td>Birth Date</td>
                     <td>Mobile</td>
                     <td>Religion</td>
                     <td>Email</td>
                     <td>Current Address</td>
                     <td>Permanent Address</td>
                     <td>Blood Group</td>
                     <td>Height</td>
                     <td>Weight</td>
                     <td>Weight as on date</td>
                     <td>previous school</td>
                     <td>driver name</td>
                     <td>driver contact</td>
                   </tr>";
         $table .= "</thead>";
         $table .= "<tbody>";
        foreach($result as $row){
            $table .= "<tr>";
                $table .= "<td>{$row->id}</td>";
                $table .= "<td>{$row->name}</td>";
                $table .= "<td>{$row->class}</td>";
                $table .= "<td>{$row->section}</td>";
                $table .= "<td>{$row->roll}</td>";
                $table .= "<td>{$row->registration_number}</td>";
                $table .= "<td>{$row->user_name}</td>";
                $table .= "<td>{$row->nid}</td>";
                $table .= "<td>{$row->birth_registration_no}</td>";
                $table .= "<td>{$row->admission_date}</td>";
                $table .= "<td>{$row->date_of_birth}</td>";
                $table .= "<td>{$row->mobile_no}</td>";
                $table .= "<td>{$row->religion}</td>";
                $table .= "<td>{$row->email}</td>";
                $table .= "<td>{$row->current_address}</td>";
                $table .= "<td>{$row->permanent_address}</td>";
                $table .= "<td>{$row->blood_group}</td>";
                $table .= "<td>{$row->height}</td>";
                $table .= "<td>{$row->weight}</td>";
                $table .= "<td>{$row->weight_as_on_date}</td>";
                $table .= "<td>{$row->previous_school}</td>";
                $table .= "<td>{$row->drive_name}</td>";
                $table .= "<td>{$row->driver_contact}</td>";
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
        $dompdf->stream();

//        return (new TestExport)->download('students.pdf', \Maatwebsite\Excel\Excel::DOMPDF);
//        return (new TestExport)->download('students.csv', \Maatwebsite\Excel\Excel::CSV);
    }

    function StudentExportCSV(){
        return Excel::download(new TestExport, 'students.csv');
    }

    /**************************************
    ------------Employee Section ----------
    ***************************************/
    function EmployeeExportPage(){
        $data['activeMenu'] = 'employee';
        $data['activePage'] = 'employee-export';
        $data['title'] = 'All Employee Export | School Management App';

        return view('pages.Employee.Export', $data);
    }

    function EmployeeExportPDF(){
        $result =Http::sms()->get('/emp/export-csv')->object();
        $table = "<table style='font-size: 12px;'>";
        $table .= "<thead>";
        $table .= "<tr>
                     <td>Name</td>
                     <td>Email</td>
                     <td>User Name</td>
                     <td>NID</td>
                     <td>Mobile</td>
                     <td>Current Address</td>
                     <td>Permanent Address</td>
                     <td>Total Salary</td>
                     <td>Blood Group</td>
                     <td>Employee Type</td>
                     <td>Gender</td>
                     <td>Birth Date</td>
                     <td>Religion</td>
                   </tr>";
        $table .= "</thead>";
        $table .= "<tbody>";
        foreach($result as $row){
            $table .= "<tr>";
                $table .= "<td>{$row->name}</td>";
                $table .= "<td>{$row->email}</td>";
                $table .= "<td>{$row->user_name}</td>";
                $table .= "<td>{$row->nid}</td>";
                $table .= "<td>{$row->mobile}</td>";
                $table .= "<td>{$row->current_address}</td>";
                $table .= "<td>{$row->permanent_address}</td>";
                $table .= "<td>{$row->total_salary}</td>";
                $table .= "<td>{$row->blood_group}</td>";
                $table .= "<td>{$row->employee_type}</td>";
                $table .= "<td>{$row->gender}</td>";
                $table .= "<td>{$row->dob}</td>";
                $table .= "<td>{$row->religion}</td>";
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
        $dompdf->stream('employees.pdf');

//        return (new TestExport)->download('students.pdf', \Maatwebsite\Excel\Excel::DOMPDF);
//        return (new TestExport)->download('students.csv', \Maatwebsite\Excel\Excel::CSV);
    }

    function EmployeeExportCSV(){
        return Excel::download(new EmployeeExport, 'employees.csv');
    }



}
