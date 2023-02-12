<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class StudentAttendanceController extends Controller
{
    function Page(){
        $data ['activeMenu'] = 'student';
        $data ['activePage'] = 'student-attendance';
        $data ['title'] = 'Student Attendance | School Management App';
        $class = Http::sms()->get('/admin/class-list');
        if($class->status() === 200){
            $data['classes'] = $class->object();
            return view('pages.Student.Attendance', $data);
        }else if($class->status() === 401){
            return redirect('/login');
        }
    }

    function GetStudent(Request $request){
        $class = $request->class;
        $section = $request->section;
        $date = $request->date;
        $query = "class={$class}&section={$section}&attendance_date={$date}";
//        return $url = env('API_URL')."/student/attendance/status?".$query;
        $url = "/student/attendance/status";
        $response = Http::sms()->get($url, [
            "class" => $class,
            "section" => $section,
            "attendance_date" => $date
        ]);
        if($response->status() === 200){
            $hasAttendance =  count($response->object());
            if($hasAttendance > 0){
                $list['action'] = 'update';
                $list['info'] = $response->object();
                return $list;
            }else{
                $students = Http::sms()->get("/student/SectionWiseStudentList?class={$class}&section={$section}");
                if($students->status() === 200){
                      $list['action'] = 'create';
                      $list['info'] = [];
                      foreach ($students->object() as $student){
                        $list ['info'] [] = (object)[
                            "std_id" => $student->id,
                            "remarks" => "",
                            "student" => (object) [
                                "id" => $student->id,
                                "class" => $student->class,
                                "roll" => $student->section,
                                "registration_number" => $student->registration_number,
                                "name" => $student->name
                            ]
                        ];
                      }
                    return $list;
                }
                else{
                    return $students->status();
                }

            }
        }
        else{
            return dd($response->object());
        }
    }

    function AddAttendance(Request $request){
//        return dd($request->all());

        $class = $request->class;
        $section = $request->section;
        $date = $request->date;
        $date = explode('/', $date);

        $studentIDs = $request->student_ids;
        $attendanceData = [];
        forEach($studentIDs as $id){
            $attendanceData [] = (object)[
              "std_id" => $id,
              "remark" => $request->input("attendance_{$id}")
            ];
        }
        $data = [
            "class" => $class,
            "section" => $section,
            "attendance_date" => $date[2]."-".$date[1]."-".$date[0],
            "students" => $attendanceData
        ];

        $url = "/student/attendance";
        $response = Http::sms()->post($url, (object)$data);
        if($response->status() === 200){
            $responseStatus =  $response->object();
            if($responseStatus->status == true){
                return redirect('/student/attendance')->with("message", $responseStatus->message);
            }else{
                return redirect('/student/attendance')->with("message", $responseStatus->message);
            }
        }else{
            return $response->object();
        }

    }

    function UpdateAttendance(Request $request){
        $class = $request->class;
        $section = $request->section;
        $date = $request->date;
        $date = explode('/', $date);

        $studentIDs = $request->student_ids;
        $attendanceData = [];
        forEach($studentIDs as $id){
            $attendanceData [] = (object)[
                "std_id" => $id,
                "remark" => $request->input("attendance_{$id}")
            ];
        }
        $data = [
            "class" => $class,
            "section" => $section,
            "attendance_date" => $date[2]."-".$date[1]."-".$date[0],
            "students" => $attendanceData
        ];

        $url = "/update/attendance";
        $response = Http::sms()->post($url, (object)$data);
        if($response->status() === 200){
            $responseStatus =  $response->object();
            if($responseStatus->status == true){
                return redirect('/student/attendance')->with("message", $responseStatus->message);
            }else{
                return redirect('/student/attendance')->with("message", $responseStatus->message);
            }
        }else{
            return $response->object();
        }
    }
}
