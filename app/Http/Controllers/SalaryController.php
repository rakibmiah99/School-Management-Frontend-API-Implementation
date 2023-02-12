<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use function Symfony\Component\Mime\toString;

class SalaryController extends Controller
{
    function Page(Request $request){
        $data['activePage'] = 'salary';
        $data['activeMenu'] = 'accounts';
        $data['title'] = 'Salary | School Management App';

        $url = "/emp/all-employee";
        $response = Http::sms()->get($url);
        if($response->status() === 200){
            $data['employees'] =  $response->object();
            return view('pages.SalaryPage', $data);
        }
        else if($response->status() === 401){
            return redirect('/login');
        }

    }


    function AssignSalary(Request $request){
        $data = [
            "emp_id" => $request->emp_id,
            'status' => 1,
            'payment_date' => date('Y-m-d'),
            'payment_month' => $request->payment_month,
            'due_amount' => $request->due_amount,
            'amount' => $request->amount,
            'paid_amount' => $request->paid_amount,
        ];

        $url = "/salary/add";
        $response = Http::sms()->asForm()->post($url, $data);
        if($response->status() === 200){
            return $response->object();
        }else{
            return $response->object();
        }
    }


    function UpdateSalary(Request $request){
        $url = "salary/update/{$request->id}";
        $data = [
            "emp_id" => $request->emp_id,
            'status' => 1,
            'payment_date' => date('Y-m-d'),
            'payment_month' => $request->payment_month,
            'due_amount' => $request->due_amount,
            'amount' => $request->amount,
            'paid_amount' => $request->paid_amount,
        ];
        $response = Http::sms()->asForm()->post($url, $data);
        if($response->status() === 200){
            return $response->object();
        }else{
            return $response->object();
        }
    }


    function SalaryList(Request $request){
        $url = "/salary/list";
        $response = Http::sms()->get($url);
        if($response->status() === 200){
            return $response->object();
        }
    }

    function Delete(Request $request){
        $url = "/salary/delete/".$request->id;
        $response = Http::sms()->delete($url);
        if($response->status() === 200){
            return $response->object();
        }
    }

    function GetSingle(Request $request){
        $url = "/salary/show/".$request->id;
        $response = Http::sms()->get($url);
        if($response->status() === 200){
            return $response->object();
        }
    }
}
