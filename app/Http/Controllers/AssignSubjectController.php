<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AssignSubjectController extends Controller
{
    function Page(){
        $subjects = Http::sms()->get('/admin/subject');
        $classes = Http::sms()->get('/admin/class-list');
        if($subjects->status() ===  200){
            $data['subjects'] = $subjects->object();
            $data['classes'] = $classes->object();
            $data['activePage'] = 'assign-subject';
            $data['activeMenu'] = 'academics';
            $data['title'] = 'Assign Subject | School Management App';
            return view('pages.Academics.AssignSubject', $data);
        }else if($subjects->status() ===  401 || $classes->status() ===  401 ){
            return redirect('/login');
        }


    }

    function Save(Request $request){
        $url = "/admin/assign-subject/create";
        $response = Http::sms()->asForm()->post($url, $request->all());
        if($response->status() === 200){
            return $response->object();
        }
        else if($response->status() === 403){
            return response()->json( $response->object(), 403);
        }
        else{
            return $response;
        }
    }
    //Update
    function Update(Request $request){
        $url = "/admin/assign-subject/update/".$request->id;
        $response = Http::sms()->asForm()->post($url, $request->all());
        if($response->status() === 200){
            return $response->object();
        }else{
            return $response;
        }
//        return $request->all();
    }

    function Get(){
        $url = "/admin/assign-subject";
        $response = Http::sms()->get($url);
        if($response->status() === 200){
            return $response->object();
        }else{
            return $response;
        }
    }


    function Delete(Request $request){
        $url = "admin/assign-subject/delete/".$request->id;
        $response = Http::sms()->delete($url);
        if($response->status() === 200){
            return $response->object();
        }
        else{
            $response->object();
        }
    }

    function GetSingle(Request $request){
        $url = "admin/assign-subject/".$request->id;
        $response = Http::sms()->get($url);
        if($response->status() === 200){
            return $response->object();
        }else{
            return $response->object();
        }
    }
}
