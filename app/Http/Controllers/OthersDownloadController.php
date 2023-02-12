<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OthersDownloadController extends Controller
{
    function Page(Request $request){

            $data["activeMenu"] = "study-material";
            $data ['activePage'] = 'other';
            $data ['title'] = 'Other Downloads | School Management App';
            return view('pages.StudyMaterial.OthersDownload', $data);

    }

    function GetContents(Request $request)
    {
        $response = Http::sms()->get('/admin/other-download-for-admin');
        if($response->status() === 200){
           return $response->object();
        }else{
            return redirect('/login');
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

        $fileName = $request->file->getClientOriginalName();

        $image = $request->file('file')->getRealPath();
        $response = Http::sms()->attach('file', file_get_contents($image), $fileName)
            ->post('/admin/other-download/create', $data);

        if ($response->status() === 200) {
            return [
                'status' => true,
                'message' => 'successfully added'
            ];
        }


        exit();
    }

    function Update(Request $request)
    {
        foreach ($request->all() as $key => $value) {
            $data[$key] = $value;
        }
        $data['date'] = date('Y-m-d', strtotime($data['date']));
        $utArray = explode(",", $data['user_type']);
        $data['user_type'] = json_encode($utArray);

        if($request->file('file') == null){
            $response = Http::sms()->post('/admin/other-download/update/'.$request->id, $data);
            if ($response->status() === 200) {
                return [
                    'status' => true,
                    'message' => 'successfully added'
                ];
            }else{
                return $response->object();
            }
            exit();
        }
        else{
            $fileName = $request->file->getClientOriginalName();

            $image = $request->file('file')->getRealPath();
            $response = Http::sms()->attach('file', file_get_contents($image), $fileName)
                ->post('/admin/other-download/update/'.$request->id, $data);

            if ($response->status() === 200) {
                return [
                    'status' => true,
                    'message' => 'successfully added'
                ];
            }else{
                return $response->object();
            }
            exit();
        }
    }



    function Delete(Request $request){
        $url = "/admin/other-download/delete/".$request->id;
        $response = Http::sms()->delete($url);
        if($response->status() === 200){
            return [
                'status' => true,
                'message' => "Deleted Successfully"
            ];
        }else{
            return [
                'status' => true,
                'message' => "Deleted Failed",
                "obj" => $response->object()
            ];
        }
    }
}
