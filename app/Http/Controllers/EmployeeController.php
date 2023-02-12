<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class EmployeeController extends Controller
{
    function Page(Request $request){
        $response = Http::sms()->get('/admin/dropdown-items?name=employeetype');
        if($response->status() === 200){
            $data['activeMenu'] = 'employee';
            $data ['activePage'] = 'add-employee';
            $data ['title'] = 'Add Employee | School Management App';
            $data ['employeeType'] = $response->object();
            return view('pages.Employee.AddEmployee', $data);
        }
        else if($response->status(401)){
            redirect('/login');
        }
    }

    function Save(Request $request){
        $formData = [];
        foreach($request->all() as $key => $value){
            if($key != "_token"){
                if($key == "dob" && $value != "" &&  $value != null ){
                    $date = explode('/', $value);
                    $formData[$key] = $date[2]."-".$date[1]."-".$date[0];
                }else{
                    $formData[$key] = $value;
                }
            }
        }

//        return $formData;
        $response = Http::sms()->asForm()->post(env('API_URL').'/register/employee', $formData);
//        return $response->status();
        if($response->status() === 201){
            return redirect('/employee/add')->with("message", "success");
        }else{
            return redirect('/employee/add')->withInput()->with("message", "failed");
        }
    }
}
