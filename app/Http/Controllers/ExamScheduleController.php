<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Client\Pool;
use Illuminate\Support\Facades\Http;
use Lcobucci\JWT\Exception;

class ExamScheduleController extends Controller
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
            $data['activePage'] = "exam-schedule";
            $data['activeMenu'] = "examination";
            $data['title'] = "Exam Schedule | School Management App";
            $data['classes'] = $responses['classes']->object();
            $data['subjects'] = $responses['subjects']->object();
            $data['teachers'] = $responses['teachers']->object();
            $data['exam_types'] = $responses['exam_types']->object();

            return view('pages.Examination.ExamSchedule', $data);
        }
        else if(
            $responses['exam_types']->status() === 401 ||
            $responses['classes']->status() === 401 ||
            $responses['subjects']->status() === 401 ||
            $responses['teachers']->status() === 401
        ){
            return redirect('/login');
        }

    }

    function Save(Request $request){
        try{
            $data = [];
            $totalItem = count($request->subject);

            for($i =0; $i < $totalItem ; $i++){
                $date = explode('/',$request->exam_date[$i]);

                $data [] = [
                    "subject" => $request->subject[$i],
                    "start_time" => $request->start_time[$i],
                    "end_time" => $request->end_time[$i],
                    "total_marks" => $request->total_marks[$i],
                    "guard" => $request->guard[$i],
                    "teacher" => $request->teacher[$i],
                    "exam_date" => $date[0]."-".$date[1]."-".$date[2],
                    "room_number" => $request->room_number[$i],
                    "class" => $request->class_id,
                    "section" => $request->section_id,
                    "exam_type" => $request->exam_type_id,
                ];
            }

            $url = "/create/exam";
            $response = Http::sms()->post($url, $data);

            if($response->status() === 200){
                $data = $response->object();
                return redirect('/examination/exam-schedule')->with('message', $data->message);
            }else{
                $data = $response->object();
                return redirect('/examination/exam-schedule')->with('message', "Please fill out all the fields.");
            }
        }
        catch(Exception $e){
            return redirect('/examination/exam-schedule')->with('message', "Created Failed.");
        }
    }

    function Get(Request $request){
        $exam_type = $request->exam_type;
        $class = $request->class;
        $section = $request->section;

        $url = "/exams?exam_type={$exam_type}&class={$class}&section={$section}";
        $response = Http::sms()->get($url);
        if($response->status() === 200){
            $hasSchedule =  $response->object();
            if(count($hasSchedule) > 0){
                return [
                    'action' => 'update',
                    'data' => $hasSchedule
                ];
            }else{
                return [
                    'action' => 'create',
                    'data' => $hasSchedule
                ];
            }
        }else{
            return $response->object();
        }
    }

    function Update(Request $request){
        try{
            $data = [];
            $totalItem = count($request->subject);

            for($i =0; $i < $totalItem ; $i++){
                $date = explode('/',$request->exam_date[$i]);

                $data [] = [
                    "subject" => $request->subject[$i],
                    "start_time" => $request->start_time[$i],
                    "end_time" => $request->end_time[$i],
                    "total_marks" => $request->total_marks[$i],
                    "guard" => $request->guard[$i],
                    "teacher" => $request->teacher[$i],
                    "exam_date" => $date[2]."-".$date[1]."-".$date[0],
                    "room_number" => $request->room_number[$i],
                    "class" => $request->class_id,
                    "section" => $request->section_id,
                    "exam_type" => $request->exam_type_id,
                ];
            }
//        return $data;

            $url = "/update/exam";
            $response = Http::sms()->post($url, $data);



            if($response->status() === 200){
                $data = $response->object();
                return redirect('/examination/exam-schedule')->with('message', $data->message);
            }else{
                $data = $response->object();
                return redirect('/examination/exam-schedule')->with('message', "Please fill out all the fields.");
            }
        }
        catch(Exception $e){
            return redirect('/examination/exam-schedule')->with('message', "Updated Failed.");
        }
    }


    function CheckSchedule(Request $request){
        $url = "/check-exam-schedule?exam_type={$request->exam_type}&class_id={$request->class}&section={$request->section}&subject={$request->subject}&exam_date={$request->exam_date}";
        return Http::sms()->get($url)->object();
    }
}
