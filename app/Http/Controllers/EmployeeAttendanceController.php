<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
class EmployeeAttendanceController extends Controller
{
    function Page(){
        $data ['activeMenu'] = 'employee';
        $data ['activePage'] = 'employee-attendance';
        $data ['title'] = 'Employee Attendance | School Management App';
        $class = Http::sms()->get('/admin/class-list');
        if($class->status() === 200){
            $data['classes'] = $class->object();
            return view('pages.Employee.Attendance', $data);
        }else if($class->status() === 401){
            return redirect('/login');
        }
    }

    function Get(Request $request){
       $url = "/emp/attendances?attendance_date={$request->date}";
       $response = Http::sms()->get($url);
       return $response->object();
    }

    function SetAttendance(Request $request){
        $url = "/emp/attendance";
        $response = Http::sms()->asForm()->post($url, $request->all());
        return $response->object();
    }


    function PresentAll(Request $request){
        $url = "/emp/present-all";
        $response = Http::sms()->asForm()->post($url, [
            'attendance_date' => $request->attendance_date
        ]);
        return $response->object();
    }

    function AbsentAll(Request $request){
        $url = "/emp/absent-all";
        $response = Http::sms()->asForm()->post($url, [
            'attendance_date' => $request->attendance_date
        ]);
        return $response->object();
    }
}
