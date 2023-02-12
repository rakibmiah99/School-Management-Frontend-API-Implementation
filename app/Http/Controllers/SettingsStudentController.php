<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
class SettingsStudentController extends Controller
{
    function Page(){
        $response = Http::sms()->get('/about-school');
        if($response->status() === 200){
            $data['activePage'] = 'settings-school';
            $data['activeMenu'] = 'settings';
            $data['title'] = 'School Settings | School Management App';
            $data['about'] = $response->object();
            return view('pages.Settings.School', $data);
        }
        else if($response->status(401)){
            redirect('/login');
        }
    }



    function Create(Request $request){
        $url = "/about-school-create-update";
        $response = Http::sms()->asForm()->post($url, $request->except(['_token']));
        return redirect("/settings/school")->with('message', $response->object()->message);
    }
}
