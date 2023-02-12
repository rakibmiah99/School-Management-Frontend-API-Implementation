<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
class IncomeTypeController extends Controller
{
    function Page(Request $request){
        $data['activePage'] = "income-type";
        $data['activeMenu'] = "accounts";
        $data['title'] = "Income Type | School Management App";
        return view('pages.Accounts.IncomeType', $data);
    }

    function Add(Request $request){
        $url = "/admin/income-type/create";
        $response = Http::sms()->asForm()->post($url, ["name" => $request->name]);
        if($response->status() === 200){
            return $response->object();
        }
        else{
            return $response->object();
        }
    }

    function Delete(Request $request){
        $url = "/admin/income-type/delete/".$request->id;
        $response = Http::sms()->delete($url);
        if($response->status() === 200){
            return $response->object();
        }
        else{
            return $response->object();
        }
    }

    function Update(Request $request){
        $url = "/admin/income-type/update/".$request->id;
        $response = Http::sms()->asForm()->post($url, ["name" => $request->name]);
        if($response->status() === 200){
            return $response->object();
        }
        else{
            return $response->object();
        }
    }

    function GetAll(Request $request){
        $url = "/admin/income-type";
        $response = Http::sms()->get($url);
        if($response->status() === 200){
            return $response->object();
        }
        else{
            return $response->object();
        }
    }

    function GetSingle(Request $request){
        $response = Http::sms()->get('/admin/income-type/'.$request->id);
        if($response->status() === 200){
            return $response->object();
        }else{
            return $response->object();
        }
    }
}
