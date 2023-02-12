<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeWorkController extends Controller
{
    function Page(Request $request){
        $response = Http::sms()->get('/admin/class-list');
        $subjects = Http::sms()->get('/admin/subject');
        if($response->status() === 200 && $subjects->status() === 200){
            $data['classes'] = $response->object();
            $data['subjects'] = $subjects->object();
            $data["activeMenu"] = "study-material";
            $data ['activePage'] = 'homework';
            $data ['title'] = 'Upload Homework | School Management App';
            return view('pages.StudyMaterial.HomeWork', $data);
        }
        else if($response->status() === 401 || $subjects->status() === 401){
            return redirect('/login');
        }
    }



    function GetAll(Request $request){
        $url = "/homeworks?class={$request->class}&section={$request->section}&subject={$request->subject}";
        $response = Http::sms()->get($url);
        if($response->status() === 200){
            return $response->object();
        }else{
            return $response->object();
        }
    }


    function Save(Request $request)
    {
        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $request->session()->get('__token'),
            'Cookie' => 'laravel_session=SsU3U7bbgS4tSZrHjmilfOF3wnASlGEpw5gjC4gM'
        ];


        $data = [
            'create_date' => Carbon::now(),
            'submission_date' => $request->submission_date,
            'title' => $request->title,
            'details' => $request->details,
            'created_by' => '1',
            'class' => $request->class,
            'subject' => $request->subject,
            'section' => $request->section,
            'file' => $request->file('file'),
        ];

        $response = null;
        if($request->file('file') != null){
            $fileName = $request->file->getClientOriginalName();

            $image = $request->file('file')->getRealPath();
            $response = Http::withHeaders($headers)->attach('file', file_get_contents($image), $fileName)
                ->post(env('API_URL').'/create/homework', $data);
        }
        else{
            $response = Http::sms()->post("/create/homework", $data);
        }


        if($response->status() === 200){
            return [
                'status' => true,
                'message' => 'successfully added'
            ];
        }
        else{
            return $response->object();
        }
        exit();
    }


    function Update(Request $request){
        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $request->session()->get('__token'),
            'Cookie' => 'laravel_session=SsU3U7bbgS4tSZrHjmilfOF3wnASlGEpw5gjC4gM'
        ];

        $data = [
            'create_date' => Carbon::now(),
            'submission_date' => $request->submission_date,
            'title' => $request->title,
            'details' => $request->details,
            'created_by' => '1',
            'class' => $request->class,
            'subject' => $request->subject,
            'section' => $request->section,
            'file' => $request->file('file')
        ];


        if($request->file('file') == null){
            $url = env("API_URL")."/update/homework/".$request->id;

            $response = Http::withHeaders($headers)->post($url, $data);

            if($response->status() === 200){
                return [
                    'status' => true,
                    'message' => 'successfully Updated'
                ];
            }
            exit();
        }else{
            $fileName = $request->file->getClientOriginalName();

            $image = $request->file('file')->getRealPath();

            $url = env("API_URL")."/update/homework/".$request->id;

            $response = Http::withHeaders($headers)->attach('file', file_get_contents($image), $fileName)->post($url, $data);

            if($response->status() === 200){
                return [
                    'status' => true,
                    'message' => 'successfully Updated'
                ];
            }
            exit();
        }

    }


    function Delete(Request $request){
        $url = "/delete/homework/".$request->id;
        $response = Http::sms()->delete($url);
        if($response->status() === 200){
            return $response->object();
        }
        else{
            return $response->object();
        }
    }

    function GetSingleHomeWork(Request $request){
        $url = "/homework/".$request->id;
        $response = Http::sms()->get($url);
        if($response->status() === 200){
            return $response->object();
        }else{
            return $response->object();
        }
    }



}
