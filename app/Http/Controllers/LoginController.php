<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    function Page(){
        return view('pages.LoginPage');
    }

    function CheckLogin(Request $request){
        $headers = [
            'Accept' => 'application/json',
        ];

        $response = Http::sms()->asForm()->post('/login', $request->all());

        if($response->status() === 200){
            $token = $response->object()->token;
            $request->session()->put('__token', $token);
            return redirect('/')->with('message', "login successfully");
        }else{
            return redirect('/login')->with('message', "phone or password don't match.");
        }
    }


    function Logout(Request $request){
        $request->session()->remove('__token');
        return redirect('/login');
    }
}
