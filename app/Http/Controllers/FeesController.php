<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FeesController extends Controller
{
    function Page(Request $request){
        $class = Http::sms()->get('/admin/class-list');
        $feeType = Http::sms()->get('/admin/fees-type');
        if($class->status() === 200 && $feeType->status() === 200){
            $data['classes'] = $class->object();
            $data['feeTypes'] = $feeType->object();
            $data['activePage'] = "fees";
            $data['activeMenu'] = "accounts";
            $data['title'] = "Fees | School Management App";
            return view('pages.Accounts.fees', $data);
        }
    }

    function GetAll(Request $request){
        $url = "/admin/fee-payable";
        $response = Http::sms()->get($url);
        if($response->status() === 200){
            return $response->object();
        }
        else{
            return $response->object();
        }
    }


    function Add(Request $request){
        $url = "/admin/fee-payable/create";
        $response = Http::sms()->asForm()->post($url, $request->all());
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


    function GetSingle(Request $request){
        $response = Http::sms()->get('/admin/subject/'.$request->id);
        if($response->status() === 200){
            return $response->object();
        }else{
            return $response->object();
        }
    }
}
