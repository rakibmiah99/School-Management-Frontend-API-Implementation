<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ClassRoutineController extends Controller
{
   function Page(Request $request){
       $classes = Http::sms()->get(env('API_URL').'/admin/class-list');
       $teachers = Http::sms()->get(env('API_URL').'/emp/list/3');
       $subjects = Http::sms()->get(env('API_URL').'/admin/subject');
       if($classes->status() === 200 && $teachers->status() === 200 && $subjects->status() === 200){
           $data['classes'] = $classes->object();
           $data['teachers'] = $teachers->object();
           $data['subjects'] = $subjects->object();
           $data ['activeMenu'] = 'academics';
           $data ['activePage'] = 'create-routine';
           $data ['title'] = 'Academics | School Management App';
           return view('pages.Academics.CreateClassRoutine', $data);
       }else if($classes->status() === 401 || $teachers->status() === 401 || $subjects->status() === 401){
           return redirect('/login');
       }
   }



   function GetRoutine(Request $request){
        $url = "/admin/class-routine?class={$request->class}&section={$request->section}";
        $response = Http::sms()->get($url);
        if($response->object() != null){
            return [
                'action' => 'update',
                'routines' => $response->object()
            ];
        }
        else{
            return [
                'action' => 'create',
                'routine' => null
            ];
        }
   }



    function AddRoutine(Request $request){
       $data = [];

       for($i = 0; $i < count($request->day); $i++){
           $data [] = (object)[
                "subject" => $request->subject[$i],
                "start_time" => $request->starttime[$i],
                "end_time" => $request->endtime[$i],
                "day" => $request->day[$i],
                "teacher" => $request->teacher[$i],
                "room_number" => $request->room[$i],
                "class" =>  $request->class,
                "section" => $request->section
           ];
       }

        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$request->session()->get('__token'),
            'Cookie' => 'laravel_session=vavhtySvWrsG3XgRdNEkRLAgSeoMW0616HQWDalL'
        ];

       $url = env('API_URL')."/admin/classtime/create";
       $response = Http::withHeaders($headers)->post($url, $data);



       if($response->status() === 200){
           return redirect('/academics/routine')->with("message" , "Added Successfully");
       }else{
           return redirect('/academics/routine')->with("message" , "Added Failed");
       }
    }

    function Update(Request $request){
        $data = [];
        for($i = 0; $i < count($request->day); $i++){
            $data [] = (object)[
                "id" => $request->id,
                "class" => $request->class,
                "section" => $request->section,
                "subject" => $request->subject[$i],
                "start_time" => $request->starttime[$i],
                "end_time" => $request->endtime[$i],
                "day" => $request->day[$i],
                "teacher" => $request->teacher[$i],
                "room_number" => $request->room[$i],
            ];
        }


        $url = "/admin/class-routine/multiple-update";
        $response = Http::sms()->post($url, $data);


        if($response->status() === 200){
            return redirect('/academics/routine')->with("message" , "Update Successfully");
        }else{
            return redirect('/academics/routine')->with("message" , "Updated Failed");
        }
    }
}
