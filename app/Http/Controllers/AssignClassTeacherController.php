<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
class AssignClassTeacherController extends Controller
{
    function Page(Request $request){
        $classes = Http::sms()->get('/admin/class-list');
        $teachers = Http::sms()->get('/emp/all-teachers');
        if($classes->status() === 200){
            $data['classes'] = $classes->object();
            $data['teachers'] = $teachers->object();
            $data['activePage'] = "assign-teacher";
            $data['title'] = "Assign Class Teacher | School Management App";
            $data['activeMenu'] = "academics";
            return view('pages.Academics.AssignClassTeacher', $data);
        }else if($classes->status() === 401){
            return redirect('/login');
        }
    }

    function Add(Request $request){
        $url = "/admin/class-teacher/create";
        $response = Http::sms()->asForm()->post($url, $request->all());
        if($response->status() === 200){
            return $response->object();
        }
        else{
            return $response->object();
        }
    }

    function Delete(Request $request){
        $url = "/admin/class-teacher/delete/".$request->id;
        $response = Http::sms()->delete($url);
        if($response->status() === 200){
            return $response->object();
        }
        else{
            return $response->object();
        }
    }

    function Update(Request $request){
        $url = "/admin/class-teacher/update/".$request->id;
        $response = Http::sms()->asForm()->post($url, $request->all());
        if($response->status() === 200){
            return $response->object();
        }
        else{
            return $response->object();
        }
    }

    function GetAll(Request $request){
        $url = "/admin/class-teacher";
        $response = Http::sms()->get($url);
        if($response->status() === 200){
            return $response->object();
        }
        else{
            return $response->object();
        }
    }

    function GetSingle(Request $request){
        $response = Http::sms()->get('/admin/class-teacher/'.$request->id);
        if($response->status() === 200){
            return $response->object();
        }else{
            return $response->object();
        }
    }
}
