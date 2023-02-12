<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ExamTypeController extends Controller
{
    function Page(Request $request){
        $data['activePage'] = "exam-type";
        $data['activeMenu'] = "examination";
        $data['title'] = "Exam Type | School Management App";
        return view('pages.Examination.ExamType', $data);
    }

    function AddExamType(Request $request){

        $url = "/admin/exam/create";
        $response = Http::sms()->asForm()->post($url, ["name" => $request->name]);
        if($response->status() === 200){
            return $response->object();
        }
        else{
            return $response->object();
        }
    }

    function DeleteExamType(Request $request){
        $url = "/admin/exam/delete/".$request->id;
        $response = Http::sms()->delete($url);
        if($response->status() === 200){
            return $response->object();
        }
        else{
            return $response->object();
        }
    }

    function UpdateExamType(Request $request){
        $url = "/admin/exam/update/".$request->id;
        $response = Http::sms()->asForm()->post($url, ["name" => $request->name]);
        if($response->status() === 200){
            return $response->object();
        }
        else{
            return $response->object();
        }
    }

    function GetAll(Request $request){

        $url = "/admin/exam";
        $response = Http::sms()->get($url);
        if($response->status() === 200){
            return $response->object();
        }
        else{
            return $response->object();
        }
    }

    function GetSingle(Request $request){
        $response = Http::sms()->get('/admin/exam/'.$request->id);
        if($response->status() === 200){
            return $response->object();
        }else{
            return $response->object();
        }
    }
}
