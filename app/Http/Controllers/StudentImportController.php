<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class StudentImportController extends Controller
{
    function Page(){
        $data['activePage'] = '';
        $data['activeMenu'] = 'students';
        $data['title'] = 'Import Student | School Management App';
        $data['classes'] = Http::sms()->get('/admin/class-list');
        if($data['classes']->status() === 200){
           $data['classes'] = $data['classes']->object();
            return view('pages.Student.import' , $data);
        }else if($data['classes']->status() === 401){
            return redirect('/login');
        }

    }


    function Save(Request $request){

        $data = [
            'class_id' => $request->class_id,
            'section_id' => $request->section_id,
        ];

        if($request->file('file') != null){
            $fileName = $request->file('file')->getClientOriginalName();
            $headers = [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . $request->session()->get('__token'),
//                "Content-Type" => "multipart/form-data",
//                'Content-Type' => 'form-data'
            ];

            $url = env('API_URL')."/student/bulk-import";
            $response = Http::withHeaders($headers)->attach('file', $request->file('file'), $fileName )->post($url, $data);

/*
            $url = "/student/bulk-import";
            $response = Http::sms()->attach('file', $request->file('file'), $fileName )->post($url, $data);
*/


//            return $response;
            if ($response->status() === 200){
                return redirect('/student/import')->with('message', $response->object()->message);
            }else{
                return redirect('/student/import')->with('message', $response->object()->message);
            }
        }
        else{
            return redirect('/student/import')->with('message', "File is Required");
        }

    }
}
