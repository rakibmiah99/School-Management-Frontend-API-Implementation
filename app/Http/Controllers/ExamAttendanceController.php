<?php

namespace App\Http\Controllers;

use Illuminate\Http\Client\Pool;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ExamAttendanceController extends Controller
{
    function Page(Request $request){
        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $request->session()->get('__token')
        ];

        $responses = Http::pool(fn (Pool $pool) => [
            $pool->as('exam_types')->withHeaders($headers)->get(env('API_URL').'/admin/exam'),
            $pool->as('classes')->withHeaders($headers)->get(env('API_URL').'/admin/class-list'),
            $pool->as('subjects')->withHeaders($headers)->get(env('API_URL').'/admin/subject'),
            $pool->as('teachers')->withHeaders($headers)->get(env('API_URL').'/emp/list/3'),
        ]);


        if(
            $responses['exam_types']->status() === 200 &&
            $responses['classes']->status() === 200 &&
            $responses['subjects']->status() === 200 &&
            $responses['teachers']->status() === 200
        ){
            $data['activePage'] = "exam-attendance";
            $data['activeMenu'] = "examination";
            $data['title'] = "Exam Attendance | School Management App";
            $data['classes'] = $responses['classes']->object();
            $data['subjects'] = $responses['subjects']->object();
            $data['teachers'] = $responses['teachers']->object();
            $data['exam_types'] = $responses['exam_types']->object();
            return view('pages.Examination.ExamAttendance', $data);
        }else if (
            $responses['exam_types']->status() === 401 ||
            $responses['classes']->status() === 401 ||
            $responses['subjects']->status() === 401 ||
            $responses['teachers']->status() === 401
        ){
            return redirect('/login');
        }
    }

    function GetStudent(Request $request){
        $hasExamAttendaceUrl = "/admin/exam-attendance?exam_id={$request->exam_type}&class_id={$request->class}&section_id={$request->section}&subject_id={$request->subject}";
        $attendance = Http::sms()->get($hasExamAttendaceUrl);
        if($attendance->status() === 200){
            $attendance = $attendance->object();
            $hasAttendance = count($attendance);
            if($hasAttendance > 0){
                $data['action'] = "update";
                $data['info'] =  $attendance;
                return $data;
            }else{
                $response = Http::sms()->get("/student/SectionWiseStudentList/{$request->class}/{$request->section}");
                if($response->status() === 200){
                   $data ['action'] = "create";
                   $data['info'] = [];
                   foreach($response->object() as $student){
                       $data['info'] [] = (object)[
                            "student_id" => $student->id,
                            "status" => 0,
                            "students" => $student
                       ];
                   }
                   return $data;
                }else{
                    return $response->object();
                }
            }
        }
    }




    function Save(Request $request){
        $attendance = [];
        $data['section_id'] = $request->section;
        $data['subject_id'] = $request->subject;
        $data['class_id'] = $request->class;
        $data['exam_id'] = $request->exam_type;
        foreach($request->student_id as $id){
            if($request->input('student'.$id) == null){
                $attendance [] = (object)[
                    "student_id" => $id,
                    "status" => 0
                ];
            }else{
                $attendance [] = (object)[
                    "student_id" => $id,
                    "status" => 1
                ];
            }
        }
        $data['students'] = $attendance;

        $data['students'];

        $url = "/admin/exam-attendance/create";
        $response = Http::sms()->post($url, (object)$data);

        if($response->status() === 200){
            $data = $response->object();
            return redirect('/examination/attendance')->with('message', $data->message);
        }else{
            $data = $response->object();
            return redirect('/examination/attendance')->with('message', $data->message);
        }
    }


    function Update(Request $request){
        $attendance = [];
        $data['section_id'] = $request->section;
        $data['subject_id'] = $request->subject;
        $data['class_id'] = $request->class;
        $data['exam_id'] = $request->exam_type;
        foreach($request->student_id as $id){
            if($request->input('student'.$id) == null){
                $attendance [] = (object)[
                    "student_id" => $id,
                    "status" => 0
                ];
            }else{
                $attendance [] = (object)[
                    "student_id" => $id,
                    "status" => 1
                ];
            }
        }
        $data['students'] = $attendance;

        $data['students'];

        $url = "/admin/exam-attendance/update";
        $response = Http::sms()->post($url, (object)$data);

        if($response->status() === 200){
            $data = $response->object();
            return redirect('/examination/attendance')->with('message', $data->message);
        }else{
            $data = $response->object();
            return redirect('/examination/attendance')->with('message', $data->message);
        }
    }

    function Delete(Request $request){
        $exam_id = $request->exam_id;
        $class_id = $request->class_id;
        $section_id = $request->section_id;
        $subject_id = $request->subject_id;

        $url = "/admin/exam-attendance/delete?exam_id={$exam_id}&class_id={$class_id}&section_id={$section_id}&subject_id={$subject_id}";
        $response = Http::sms()->delete($url);
        if($response->status() === 200){
            return $response->object();
        }else{
            return $response->object();
        }
    }


}
