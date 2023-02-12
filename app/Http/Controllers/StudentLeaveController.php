<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class StudentLeaveController extends Controller
{
    function Page(){

        $class_list = Http::sms()->get('/admin/class-list');

        if(
            $class_list->status() === 200
        ) {
            $data['classes'] = $class_list->object();
            $data['activePage'] = 'leave-student';
            $data['activeMenu'] = 'leave';
            $data['title'] = 'Define Student Leave | School Management App';
            return view('pages.Leave.StudentLeave', $data);
        }
        else if($class_list->status() === 401) {
            return redirect('/login');
        }
    }

    function Save(Request $request){

        foreach ($request->all() as $key => $value) {
            $data[$key] = $value;
        }

        if($request->file == null){
            $url = '/admin/student-leave/create';
            $response = Http::sms()->post($url, $data);
            if ($response->status() === 200) {
                return [
                    'status' => true,
                    'message' => 'successfully added'
                ];
            }
        }
        else{
            $fileName = $request->file->getClientOriginalName();
            $image = $request->file('file')->getRealPath();
            $url = '/admin/student-leave/create';
            $response = Http::sms()->attach('file', file_get_contents($image), $fileName)->post($url, $data);
            if ($response->status() === 200) {
                return [
                    'status' => true,
                    'message' => 'successfully added'
                ];
            }
        }

        exit();
    }

    function Delete(Request $request){
        $url = "/admin/employee-leave/delete/".$request->id;
        $response = Http::sms()->delete($url);
        if($response->status() === 200){
            return $response->object();
        }
        else{
            return $response->object();
        }
    }

    function Update(Request $request){
        foreach ($request->all() as $key => $value) {
            $data[$key] = $value;
        }

//        return $request->all();
        if($request->file == null){
            $url = '/admin/student-leave/update/'.$request->id;
            $response = Http::sms()->post($url, $data);
            if ($response->status() === 200) {
                return [
                    'status' => true,
                    'message' => 'successfully updated'
                ];
            }
        }
        else{
            $fileName = $request->file->getClientOriginalName();
            $image = $request->file('file')->getRealPath();
            $url = '/admin/student-leave/update/'.$request->id;
            $response = Http::sms()->attach('file', file_get_contents($image), $fileName)->post($url, $data);
            if ($response->status() === 200) {
                return [
                    'status' => true,
                    'message' => 'successfully updated'
                ];
            }
        }
        exit();
    }

    function GetAll(Request $request){

        $url = "/admin/student-leave";
        $response = Http::sms()->get($url);
        if($response->status() === 200){
            return $response->object();
        }
        else{
            return $response->object();
        }
    }

    function GetSingle(Request $request){
        $response = Http::sms()->get('/admin/student-leave/'.$request->id);
        if($response->status() === 200){
            return $response->object();
        }else{
            return $response->object();
        }
    }
}
