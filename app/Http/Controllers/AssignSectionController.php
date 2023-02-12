<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
class AssignSectionController extends Controller
{
    function Page(Request $request){
        $classes = Http::sms()->get(env('API_URL').'/admin/class-list');
        $sections = Http::sms()->get(env('API_URL').'/admin/section-list');
        if($classes->status() === 200){
            $data['classes'] = $classes->object();
            $data['sections'] = $sections->object();
            $data['activePage'] = "assign-section";
            $data['activeMenu'] = "academics";
            $data['title'] = "Assign Section | School Management App";
            return view('pages.Academics.AssignSection', $data);
        }else if($classes->status() === 401){
            return redirect('/login');
        }

    }

    function Add(Request $request){
        $url = "/admin/assign-section/create";
        $response = Http::sms()->asForm()->post($url, $request->all());
        if($response->status() === 200){
            return $response->object();
        }
        else{
            return $response->object();
        }
    }

    function Delete(Request $request){
        $url = "/admin/assign-section/delete/".$request->id;
        $response = Http::sms()->delete($url);
        if($response->status() === 200){
            return $response->object();
        }
        else{
            return $response->object();
        }
    }

    function Update(Request $request){
//        $url = "/admin/assign-section/update/".$request->id;
        $url = "/admin/assign-section/update";
        $response = Http::sms()->asForm()->post($url, $request->all());
        if($response->status() === 200){
            return $response->object();
        }
        else{
            return $response->object();
        }
    }

    function GetAll(Request $request){
        $url = "/admin/assign-section";
        $response = Http::sms()->get($url);
        if($response->status() === 200){
            return $response->object();
        }
        else{
            return $response->object();
        }
    }

    function GetSingle(Request $request){
        $response = Http::sms()->get('/admin/assign-section/'.$request->id);
        if($response->status() === 200){
            return $response->object();
        }else{
            return $response->object();
        }
    }
}
