<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UserStudentController extends Controller
{
    function Page(){
        $guardian = Http::sms()->get('/parent-list');
        $classes = Http::sms()->get('/admin/class-list');
        if($guardian->status() === 200){
            $data['activePage'] = 'users-student';
            $data['activeMenu'] = 'users';
            $data['title'] = 'Student | School Management App';
            $data['guardians'] = $guardian->object();
            $data['classes'] = $classes->object();
            return view('pages.Users.student', $data);
        }else{

        }

    }

    function Get(){
        $url = "/student/export-csv";
        $response = Http::sms()->get($url);
        return $response->object();
    }

    function GetSingle(Request $request){
        $url = "student/details/{$request->id}";
        $response = Http::sms()->get($url);
        return $response->object();
    }

    function Delete(Request $request){
        $url = "/student/delete";
        $response = Http::sms()->asForm()->post($url, ['id' => $request->id ]);
        return $response->object();
    }

    function Update(Request $request){
        $url = "student/edit/{$request->id}";
//        return $request->all();
        $response = Http::sms()->asForm()->post($url, $request->all());
        return $response->object();
    }
}
