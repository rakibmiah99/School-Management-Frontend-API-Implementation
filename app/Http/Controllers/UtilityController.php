<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class UtilityController extends Controller
{
    //Get Class Wise Section
    function ClassWiseSection(Request $request){
        $class_id = $request->class_id;

        $response = Http::sms()->get('/admin/section-list/class/'.$class_id);
        if($response->status() === 200){
            return $response->object();
        }else if($response->status() === 401){
            return redirect('/login');
        }else{
            return $response->object();
        }
    }

    function ClassAndSectionWiseStudent(Request $request){
        $url = "student/SectionWiseStudentList?class={$request->class}&section={$request->section}";
//        $url = "student/SectionWiseStudentList/{$request->class}/{$request->section}";
        $response = Http::sms()->get($url);
        if($response->status() === 200){
            return $response->object();
        }else if($response->status() === 401){
            return redirect('/login');
        }else{
            return $response->object();
        }
    }

    //Get Notification
    function GetNotifications(){
        $url = "/all-admin-notifications";
        $response = Http::sms()->get($url);
        if($response->status() === 200){
            return $response->object();
        }else{
            return null;
        }
    }

    function ReadAllNotification(Request $request){
        $url = "/notification/mark-all-as-read";
        $response = Http::sms()->get($url);
        return $response->object();
    }
}
