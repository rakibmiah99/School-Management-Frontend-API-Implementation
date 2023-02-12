<?php

namespace App\Http\Controllers;

use Illuminate\Http\Client\Pool;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class EmployeeLeaveController extends Controller
{
    function Page(){

            $leave_type = Http::sms()->get(env('API_URL').'/admin/leave-type');
            $employees = Http::sms()->get(env('API_URL').'/emp/all-employee');

        if(
            $leave_type->status() === 200 &&
            $employees->status() === 200
        ) {
            $data['leaveTypes'] = $leave_type->object();
            $data['employees'] = $employees->object();
            $data['activePage'] = 'leave-employee';
            $data['activeMenu'] = 'leave';
            $data['title'] = 'Define Employee Leave | School Management App';
            return view('pages.Leave.EmployeeLeave', $data);
        }
        else if($leave_type->status() === 401) {
            return redirect('/login');
        }
    }

    function Save(Request $request){

        foreach ($request->all() as $key => $value) {
            $data[$key] = $value;
        }


        if($data['file'] != "undefined"){
            $fileName = $request->file->getClientOriginalName();

            $image = $request->file('file')->getRealPath();
            $response = Http::sms()->attach('file', file_get_contents($image), $fileName)
                ->post('/admin/employee-leave/create', $data);

            if ($response->status() === 200) {
                return [
                    'status' => true,
                    'message' => 'successfully added'
                ];
            }
            return $response;
        }else{
            unset($data['file']);
            $response = Http::sms()->asForm()->post('/admin/employee-leave/create', $data);

            if ($response->status() === 200) {
                return $response->object();
            }else{
                return $response->object();
            }
        }
        exit();
    }

    function Delete(Request $request){
        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $request->session()->get('__token'),
            'Cookie' => 'laravel_session=SsU3U7bbgS4tSZrHjmilfOF3wnASlGEpw5gjC4gM'
        ];
        $url = env('API_URL')."/admin/employee-leave/delete/".$request->id;
        $response = Http::withHeaders($headers)->delete($url);
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

        if($data['file'] != "undefined"){
            $fileName = $request->file->getClientOriginalName();

            $image = $request->file('file')->getRealPath();
            $response = Http::sms()->attach('file', file_get_contents($image), $fileName)
                ->post('/admin/employee-leave/update/'.$request->id, $data);

            if ($response->status() === 200) {
                return $response->object();
            }
        }else{
            unset($data['file']);
            $response = Http::sms()->asForm()->post('/admin/employee-leave/update/'.$request->id, $data);

            if ($response->status() === 200) {
                $response->object();
            }else{
                return $response->object();
            }
        }


        exit();
    }

    function GetAll(Request $request){
        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $request->session()->get('__token'),
            'Cookie' => 'laravel_session=SsU3U7bbgS4tSZrHjmilfOF3wnASlGEpw5gjC4gM'
        ];

        $url = env('API_URL')."/admin/employee-leave";
        $response = Http::withHeaders($headers)->get($url);
        if($response->status() === 200){
            return $response->object();
        }
        else{
            return $response->object();
        }
    }

    function GetSingle(Request $request){
        $response = Http::sms()->get('/admin/employee-leave/'.$request->id);
        if($response->status() === 200){
            return $response->object();
        }else{
            return $response->object();
        }
    }
}
