<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
class AddIncomeController extends Controller
{
    function Page(Request $request){
        $response = Http::sms()->get('/admin/income-type');
        if($response->status() === 200){
            $data['income_types'] = $response->object();
            $data['activePage'] = "add-income";
            $data['activeMenu'] = "accounts";
            $data['title'] = "Add Income | School Management App";
            return view('pages.Accounts.AddIncome', $data);
        }
        else if($response->status() === 401){
            return redirect('/login');
        }
    }


    function Add(Request $request){
        $url = "/admin/income/create";
        $response = Http::sms()->asForm()->post($url, $request->all());
        if($response->status() === 200){
            return $response->object();
        }
        else{
            return $response->object();
        }
    }

    function Delete(Request $request){
        $url = "/admin/income/delete/".$request->id;
        $response = Http::sms()->delete($url);
        if($response->status() === 200){
            return $response->object();
        }
        else{
            return $response->object();
        }
    }

    function Update(Request $request){
        $url = "/admin/income/update/".$request->id;
        $response = Http::sms()->asForm()->post($url, $request->all());
        if($response->status() === 200){
            return $response->object();
        }
        else{
            return $response->object();
        }
    }

    function GetAll(Request $request){
        $url = "/admin/income";
        $response = Http::sms()->get($url);
        if($response->status() === 200){
            return $response->object();
        }
        else{
            return $response->object();
        }
    }

    function GetSingle(Request $request){
        $response = Http::sms()->get('/admin/income/'.$request->id);
        if($response->status() === 200){
            return $response->object();
        }else{
            return $response->object();
        }
    }
}
