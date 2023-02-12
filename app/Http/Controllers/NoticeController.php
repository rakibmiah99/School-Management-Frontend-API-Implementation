<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class NoticeController extends Controller
{
    function Page(){
        $data ['activeMenu'] = 'notice';
        $data ['activePage'] = 'notice';
        $data ['title'] = 'Notice Board | School Management App';
        return view('pages.NoticeBoard', $data);
    }


    function GetNotice(Request $request){

        $url = '/admin/notice';
        $response = Http::sms()->get($url);
        if($response->status() === 200){
            return $response->object();
        }else{
            return $response;
        }
    }

    function GetSingle(Request $request){
        $url = "/admin/notice/".$request->id;
        $response = Http::sms()->get($url);
        if($response->status() === 200){
            return $response->object();
        }else{
            return $response->object();
        }
    }

    function Save(Request $request)
    {

        foreach ($request->all() as $key => $value) {
            $data[$key] = $value;
        }
        $data['date'] = date('Y-m-d', strtotime($data['date']));
        $utArray = explode(",", $data['user_type']);
        $data['user_type'] = json_encode($utArray);

        $url = "/admin/notice/create";
        if($request->file('file') !== null){
            $fileName = $request->file->getClientOriginalName();
            $image = $request->file('file')->getRealPath();

            $response = Http::sms()->attach('file', file_get_contents($image), $fileName)
                ->post($url , $data);

            if($response->status() === 200){
                return $response->object();
            }else{
                return $response->object();
            }
        }
        else{
            $response = Http::sms()->post($url , $data);

            if($response->status() === 200){
                return $response->object();
            }else{
                return $response->object();
            }
        }

        exit();
    }


    function Edit(Request $request)
    {

        foreach ($request->all() as $key => $value) {
            $data[$key] = $value;
        }

        $data['date'] = date('Y-m-d', strtotime($data['date']));
        $utArray = explode(",", $data['user_type']);
        $data['user_type'] = json_encode($utArray);
//return var_dump($request->file('file'));


        if($request->file('file') == null ){

            $url = "/admin/notice/update/".$request->id;
            $response = Http::sms()->post($url , $data);
            if($response->status() === 200){
                return $response->object();
            }else{
                return $response->object();
            }
            exit();
        }
        else{
//            return dd($request->file('file'));
            $fileName = $request->file->getClientOriginalName();

            $image = $request->file('file')->getRealPath();
            $url = "/admin/notice/update/".$request->id;
            $response = Http::sms()->attach('file', file_get_contents($image), $fileName)
                ->post($url , $data);

            if($response->status() === 200){
                return $response->object();
            }else{
                return $response->object();
            }
            exit();
        }
    }


    function Delete(Request $request){
        $url = "/admin/notice/delete/".$request->id;
        $response = Http::sms()->delete($url);
        if($response->status() === 200){
            return $response->object();
        }else{
            return $response->object();
        }
    }
}
