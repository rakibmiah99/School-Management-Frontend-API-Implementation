<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FeeTypeController extends Controller
{
    function Page(Request $request){
        $data['activePage'] = "fee-type";
        $data['activeMenu'] = "accounts";
        $data['title'] = "Fee Type | School Management App";
        return view('pages.Accounts.FeeType', $data);
    }

    function AddExamType(Request $request){
        $url = "/admin/fees-type/create";
        $response = Http::sms()->asForm()->post($url, ["name" => $request->name]);
        if($response->status() === 200){
            return $response->object();
        }
        else{
            return $response->object();
        }
    }

    function DeleteExamType(Request $request){
        $url = "/admin/fees-type/delete/".$request->id;
        $response = Http::sms()->delete($url);
        if($response->status() === 200){
            return $response->object();
        }
        else{
            return $response->object();
        }
    }

    function UpdateExamType(Request $request){

        $url = "/admin/fees-type/update/".$request->id;
        $response = Http::sms()->asForm()->post($url, ["name" => $request->name]);
        if($response->status() === 200){
            return $response->object();
        }
        else{
            return $response->object();
        }
    }

    function GetAll(Request $request){
        $url = "/admin/fees-type";
        $response = Http::sms()->get($url);
        if($response->status() === 200){
            return $response->object();
        }
        else{
            return $response->object();
        }
    }

    function GetSingle(Request $request){
        $response = Http::sms()->get('/admin/fees-type/'.$request->id);
        if($response->status() === 200){
            return $response->object();
        }else{
            return $response->object();
        }
    }
}
