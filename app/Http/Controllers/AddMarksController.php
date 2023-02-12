<?php

namespace App\Http\Controllers;

use Illuminate\Http\Client\Pool;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AddMarksController extends Controller
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
            $data['activePage'] = "add-marks";
            $data['activeMenu'] = "examination";
            $data['title'] = "Add Marks | School Management App";
            $data['classes'] = $responses['classes']->object();
            $data['subjects'] = $responses['subjects']->object();
            $data['teachers'] = $responses['teachers']->object();
            $data['exam_types'] = $responses['exam_types']->object();
            return view('pages.Examination.AddMark', $data);
        }else if(
            $responses['exam_types']->status() === 401 ||
            $responses['classes']->status() === 401 ||
            $responses['subjects']->status() === 401 ||
            $responses['teachers']->status() === 401
        ){
            return redirect('/login');
        }
    }

    function Get(Request $request){

        $exam = $request->exam_type;
        $class = $request->class;
        $section = $request->section;
        $subject = $request->subject;

        $getMarkUrl = "/admin/marks?exam_id={$exam}&class_id={$class}&section_id={$section}&subject_id={$subject}";
        $getMark = Http::sms()->get($getMarkUrl);
        if($getMark->status() === 200){
           $hasMark = count( $getMark->object()->data);
            if($hasMark > 0){
                $data['action'] = "update";
                $data['total_marks'] = $getMark->object()->total_marks->total_marks;
                $data['info'] = $getMark->object()->data;
                return $data;
            }
            else if($getMark->object()->total_marks != null){
                $response = Http::sms()->get("/student/SectionWiseStudentList?class={$request->class}&section={$request->section}");
                if($response->status() === 200){
                    $data['action'] = "create";
                    $data['total_marks'] = $getMark->object()->total_marks->total_marks;
                    $data['info'] = [];
                    foreach($response->object() as $student){
                        $data['info'] [] = (object)[
                            "student_id" => $student->id,
                            "marks" => 0,
                            "students" => $student
                        ];
                    }
                    return $data;
                }else{
                    return $response->object();
                }
            }
            else{
                $data['action'] = "error";
                return $data;
            }
        }else if($getMark->status() === 401){
            return redirect('/login');
        }

    }


    function Save(Request $request){
        $studentsMarks = [];
        $data['section_id'] = $request->section;
        $data['subject_id'] = $request->subject;
        $data['class_id'] = $request->class;
        $data['exam_id'] = $request->exam_type;
        foreach($request->student_id as $id){
            if($request->input('student'.$id) == null){
                $studentsMarks [] = (object)[
                    "student_id" => $id,
                    "marks" => 0
                ];
            }else{
                $studentsMarks [] = (object)[
                    "student_id" => $id,
                    "marks" => $request->input('student'.$id)
                ];
            }
        }
        $data['students'] = $studentsMarks;

        $data['students'];


        $url = "/admin/marks/create";
        $response = Http::sms()->post($url, (object)$data);

        if($response->status() === 200){
            $data = $response->object();
            return redirect('/examination/add-mark')->with('message', $data->message);
        }
        else if($response->status() === 401){
            return redirect('/login');
        }
        else{
            $data = $response->object();
            return redirect('/examination/add-mark')->with('message', $data->message);
        }
    }

    function Update(Request $request){
        $studentsMarks = [];
        $data['section_id'] = $request->section;
        $data['subject_id'] = $request->subject;
        $data['class_id'] = $request->class;
        $data['exam_id'] = $request->exam_type;
        foreach($request->student_id as $id){
            if($request->input('student'.$id) == null){
                $studentsMarks [] = (object)[
                    "student_id" => $id,
                    "marks" => 0
                ];
            }else{
                $studentsMarks [] = (object)[
                    "student_id" => $id,
                    "marks" => $request->input('student'.$id)
                ];
            }
        }
        $data['students'] = $studentsMarks;

        $data['students'];


        $url = "/admin/marks/update";
        $response = Http::sms()->post($url, (object)$data);

        if($response->status() === 200){
            $data = $response->object();
            return redirect('/examination/add-mark')->with('message', $data->message);
        }
        else if($response->status() === 401){
            return redirect('/login');
        }
        else{
            $data = $response->object();
            return redirect('/examination/add-mark')->with('message', $data->message);
        }
    }


    function GetOne(Request $request){

        $exam = $request->exam_type;
        $class = $request->class;
        $section = $request->section;
        $subject = $request->subject;

        $getMarkUrl = "/admin/marks?exam_id={$exam}&class_id={$class}&section_id={$section}&subject_id={$subject}";
        $getMark = Http::sms()->get($getMarkUrl);
        if($getMark->status() === 200){
            $hasMark = count( $getMark->object()->data);
            if($hasMark > 0){
                $data['action'] = "error";
                $data['total_marks'] = $getMark->object()->total_marks->total_marks;
                $data['std_info'] = $getMark->object()->data;
                return $data;
            }
            else if($getMark->object()->total_marks != null){
                $response = Http::sms()->get("/student/SectionWiseStudentList?class={$request->class}&section={$request->section}");
                if($response->status() === 200){
                    $data['action'] = "success";
                    $data['total_marks'] = $getMark->object()->total_marks->total_marks;
                    $data['std_info'] = [];
                    foreach($response->object() as $student){
                        $data['info'] [] = (object)[
                            "student_id" => $student->id,
                            "marks" => 0,
                            "students" => $student
                        ];
                    }
                    return $data;
                }else{
                    return $response->object();
                }
            }
            else{
                $data['action'] = "error";
                return $data;
            }
        }else if($getMark->status() === 401){
            return redirect('/login');
        }

    }

}
