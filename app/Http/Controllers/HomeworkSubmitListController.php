<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeworkSubmitListController extends Controller
{
    //
    function Page(Request $request){
        $response = Http::sms()->get('/admin/class-list');
        $subjects = Http::sms()->get('/admin/subject');
        if($response->status() === 200 && $subjects->status() === 200){
            $data['classes'] = $response->object();
            $data['subjects'] = $subjects->object();
            $data["activeMenu"] = "study-material";
            $data ['activePage'] = 'all-homework';
            $data ['title'] = 'All Homeworks | School Management App';
            return view('pages.StudyMaterial.HomeWorkSubmit', $data);
        }
        else if($response->status() === 401 || $subjects->status() === 401){
            return redirect('/login');
        }
    }



    function GetAll(Request $request){
        $url = "/admin/submitted-list?homework_id=".$request->id;
        $response = Http::sms()->get($url);
        if($response->status() === 200){
            return $response->object();
        }else{
            return $response->object();
        }
    }



    function Delete(Request $request){
        $url = "/homework-submission/delete/".$request->id;
        $response = Http::sms()->delete($url);
        if($response->status() === 200){
            return $response->object();
        }
        else{
            return $response->object();
        }
    }

    function GetSingleHomeWork(Request $request){
        $url = "/admin/submitted-list?homework_id=".$request->id;
        $response = Http::sms()->get($url);
        if($response->status() === 200){
            return $response->object();
        }else{
            return $response->object();
        }
    }
}
