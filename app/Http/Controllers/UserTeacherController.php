<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
class UserTeacherController extends Controller
{
    function Page(){
        $response = Http::sms()->get('/admin/dropdown-items?name=employeetype');
        if($response->status() === 200){
            $data['activePage'] = 'users-teacher';
            $data['activeMenu'] = 'users';
            $data['title'] = 'Teacher | School Management App';
            $data ['employeeType'] = $response->object();
            return view('pages.Users.Teacher', $data);
        }
        else if($response->status(401)){
            redirect('/login');
        }

    }

    function Get(){
        $url = "/emp/all-teachers";
        $response = Http::sms()->get($url);
        return $response->object();
    }

    function GetSingle(Request $request){
        $url = "/emp/employee-details/{$request->id}";
        $response = Http::sms()->get($url);
        return $response->object();
    }

    function Delete(Request $request){
        $url = "/emp/Delete/". $request->id;
        $response = Http::sms()->get($url);
        return $response->object();
    }

    function Update(Request $request){
        $url = "/update-profile-by-admin/3";
        $response = Http::sms()->asForm()->post($url, $request->all());
        return $response->object();
    }
}
