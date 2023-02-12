<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
class AddExpenseController extends Controller
{
    function Page(Request $request){
        $response = Http::sms()->get('/admin/expense-type');
        if($response->status() === 200){
            $data['expense_types'] = $response->object();
            $data['activePage'] = "add-expense";
            $data['activeMenu'] = "accounts";
            $data['title'] = "Add Expense | School Management App";
            return view('pages.Accounts.AddExpense', $data);
        }
        else if($response->status() === 401){
            return redirect('/login');
        }
    }


    function Add(Request $request){
        $url = "/admin/expense/create";
        $response = Http::sms()->asForm()->post($url, $request->all());
        if($response->status() === 200){
            return $response->object();
        }
        else{
            return $response->object();
        }
    }

    function Delete(Request $request){
        $url = "/admin/expense/delete/".$request->id;
        $response = Http::sms()->delete($url);
        if($response->status() === 200){
            return $response->object();
        }
        else{
            return $response->object();
        }
    }

    function Update(Request $request){
        $url = "/admin/expense/update/".$request->id;
        $response = Http::sms()->asForm()->post($url, $request->all());
        if($response->status() === 200){
            return $response->object();
        }
        else{
            return $response->object();
        }
    }

    function GetAll(Request $request){
        $url = "/admin/expense";
        $response = Http::sms()->get($url);
        if($response->status() === 200){
            return $response->object();
        }
        else{
            return $response->object();
        }
    }

    function GetSingle(Request $request){
        $response = Http::sms()->get('/admin/expense/'.$request->id);
        if($response->status() === 200){
            return $response->object();
        }else{
            return $response->object();
        }
    }
}
