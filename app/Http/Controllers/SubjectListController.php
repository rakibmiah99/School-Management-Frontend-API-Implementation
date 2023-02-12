<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SubjectListController extends Controller
{
    function Page(Request $request){
        $data['activePage'] = "subject-list";
        $data['activeMenu'] = "academics";
        $data['title'] = "Subject List | School Management App";
        return view('pages.Academics.SubjectList', $data);
    }

    function Add(Request $request){
        $url = "/admin/subject/create";
        $response = Http::sms()->asForm()->post($url, ["name" => $request->name]);
        if($response->status() === 200){
            return $response->object();
        }
        else{
            return $response->object();
        }
    }

    function Delete(Request $request){
        $url = "/admin/subject/delete/".$request->id;
        $response = Http::sms()->delete($url);
        if($response->status() === 200){
            return $response->object();
        }
        else{
            return $response->object();
        }
    }

    function Update(Request $request){
        $url = "/admin/subject/update/".$request->id;
        $response = Http::sms()->asForm()->post($url, ["name" => $request->name]);
        if($response->status() === 200){
            return $response->object();
        }
        else{
            return $response->object();
        }
    }

    function GetAll(Request $request){
        $url = "/admin/subject";
        $response = Http::sms()->get($url);
        if($response->status() === 200){
            return $response->object();
        }
        else{
            return $response->object();
        }
    }

    function GetSingle(Request $request){
        $response = Http::sms()->get('/admin/subject/'.$request->id);
        if($response->status() === 200){
            return $response->object();
        }else{
            return $response->object();
        }
    }
}
