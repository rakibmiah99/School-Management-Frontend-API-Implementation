<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class UserAdminController extends Controller
{
    function Page(){
        $data['activePage'] = 'users-admin';
        $data['activeMenu'] = 'users';
        $data['title'] = 'Admin | School Management App';
        return view('pages.Users.admin', $data);
    }


    function Create(Request $request){
        $url = "/register/admin";
        $response = Http::sms()->asForm()->post($url, $request->all());
        return $response->object();
    }

    function Get(){
        $url = "/admin/all-admin";
        $response = Http::sms()->get($url);
        return $response->object();
    }

    function GetSingle(Request $request){
        $url = "/admin/details/{$request->id}";
        $response = Http::sms()->get($url);
        return $response->object();
    }

    function Delete(Request $request){
        $url = "/student/delete";
        $response = Http::sms()->asForm()->post($url, ['id' => $request->id ]);
        return $response->object();
    }

    function Update(Request $request){
        $url = "/admin-profile/update";
        $response = Http::sms()->asForm()->post($url, $request->all());
        return $response->object();
    }
}
