<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AddSectionController extends Controller
{
    function Page(Request $request){
        $data['activePage'] = "add-section";
        $data['title'] = "Add Section | School Management App";
        $data['activeMenu'] = "academics";
        return view('pages.Academics.AddSection', $data);
    }

    function Add(Request $request){
        $url = "/admin/section-list/create";
        $response = Http::sms()->asForm()->post($url, ["name" => $request->name]);
        if($response->status() === 200){
            return $response->object();
        }
        else{
            return $response->object();
        }
    }

    function Delete(Request $request){
        $url = "/admin/section-list/delete/".$request->id;
        $response = Http::sms()->delete($url);
        if($response->status() === 200){
            return $response->object();
        }
        else{
            return $response->object();
        }
    }

    function Update(Request $request){
        $url = "/admin/section-list/update/".$request->id;
        $response = Http::sms()->asForm()->post($url, ["name" => $request->name]);
        if($response->status() === 200){
            return $response->object();
        }
        else{
            return $response->object();
        }
    }

    function GetAll(Request $request){
        $url = "/admin/section-list";
        $response = Http::sms()->get($url);
        if($response->status() === 200){
            return $response->object();
        }
        else{
            return $response->object();
        }
    }

    function GetSingle(Request $request){
        $response = Http::sms()->get('/admin/section-list/'.$request->id);
        if($response->status() === 200){
            return $response->object();
        }else{
            return $response->object();
        }
    }
}
